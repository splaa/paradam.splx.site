<?php

namespace app\modules\message\controllers;

use app\modules\message\forms\MessageForm;
use app\modules\message\forms\SettingsForm;
use app\modules\message\models\Message;
use app\modules\message\models\Thread;
use app\modules\message\models\UserMessage;
use app\modules\message\models\UserThread;
use app\modules\user\controllers\UserController;
use app\modules\user\models\User;
use Yii;
use \app\components\Hash;
use yii\bootstrap\ActiveForm;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\web\View;
use YoHang88\LetterAvatar\LetterAvatar;

/**
 * Default controller for the `message` module
 */
class MessageController extends UserController
{
	public function beforeAction($action)
	{
		$this->enableCsrfValidation = false;
		return parent::beforeAction($action);
	}

	/**
	 * @param string $id
	 * @return string
	 * @throws \yii\base\InvalidConfigException
	 */
	public function actionIndex()
	{
		$this->view->registerCssFile('@web/css/chat.css');

		$threads = UserThread::find()
			->where(['user_id' => Yii::$app->user->id])
			->orderBy(['id' => SORT_DESC])
			->all();

		$selected_user_thread = [];

		$model = new SettingsForm();

		return $this->render('index', [
			'model' => $model,
			'threads' => $threads,
			'selected_user_thread' => $selected_user_thread
		]);
	}

	public function actionView($id = '')
	{
		$this->view->registerCssFile('@web/css/chat.css');
		$this->view->registerJsFile('@web/js/ws.js');
		$this->view->registerJsFile('@web/js/recorder.js');
		$this->view->registerJsFile('@web/js/record.js');

		$threads = UserThread::find()
			->where(['user_id' => Yii::$app->user->id])
			->orderBy(['id' => SORT_DESC])
			->all();

		$selected_user_thread = [];

		if ($id) {
			// Decode Hash
			$hash = new Hash();
			$hash->string = $id;

			$selected_user_thread = UserThread::find()
				->where(['thread_id' =>  $hash->run(Hash::DECODE)])
				->andWhere(['user_id' => Yii::$app->user->id])
				->one();
		}

		$model = new SettingsForm();

		return $this->render('index', [
			'model' => $model,
			'threads' => $threads,
			'selected_user_thread' => $selected_user_thread
		]);
	}

	public function actionSettings()
	{
		$model = new SettingsForm();

		if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->changeSmsCost()) {
			if (!Yii::$app->request->isPjax && !Yii::$app->request->isAjax) {
				Yii::$app->getSession()->setFlash('success', 'Спасибо! Стоимость сообщения изменена.');

				return $this->refresh();
			}
		}

		if (!Yii::$app->request->isPjax && !Yii::$app->request->isAjax) {
			return $this->render('settings', [
				'model' => $model
			]);
		}
	}

	public function actionCreate()
	{
		if (Yii::$app->request->isPost || Yii::$app->request->isAjax) {
			$model = new MessageForm();

			if ($model->load(Yii::$app->request->post()) && $model->validate()) {
				$sender_id = Yii::$app->user->id;
				$recipient_id = $model->user_id;

				if (User::validateSendMessage($sender_id, $recipient_id, 0)) {
					$text = $model->text;

					$thread = Thread::find()->alias('t')
						->innerJoin('user_thread as ut1', 't.id = ut1.thread_id')
						->innerJoin('user_thread as ut2', 't.id = ut2.thread_id')
						->where(['ut1.user_id' => $sender_id, 'ut2.user_id' => $recipient_id])
						->orWhere(['ut1.user_id' => $recipient_id, 'ut2.user_id' => $sender_id])
						->groupBy('t.id')
						->asArray()
						->one();

					if ($thread) {
						$thread_id = $thread['id'];
					} else {
						$thread = new Thread();
						$thread->title = $sender_id . '=>' . $recipient_id;
						$thread->creator_id = $recipient_id;
						$thread->save();
						$thread_id = $thread->id;

						$user_thread = new UserThread();
						$user_thread->user_id = $recipient_id;
						$user_thread->thread_id = $thread_id;
						$user_thread->save();
					}

					$message = new Message();
					$message->author_id = $sender_id;
					$message->thread_id = $thread_id;
					$message->text = $text;
					$message->save();

					$user_message = new UserMessage();
					$user_message->user_id = $sender_id;
					$user_message->message_id = $message->id;
					$user_message->save();

					// Minus from balance
					if (mb_strlen($text, 'UTF-8') > USER::MESSAGE_LENGTH) {
						$factor = count(User::strSplitUnicode($text, USER::MESSAGE_LENGTH));
					} else {
						$factor = 1;
					}

					User::transferBits($sender_id, $recipient_id, User::TRANSFER_TYPE_SMS, 0, $factor);

					$hash = new Hash();
					$hash->string = $thread_id;

					return $this->redirect(Url::to(['view', 'id' => $hash->run(Hash::ENCODE)]));
				} else {
					Yii::$app->getSession()->setFlash('error', 'На счету не достаточно средств пожалуйста пополните Ваш баланс.');
					return $this->redirect(Url::to(['/user/profile/balance']));
				}
			}
		} else {
			throw new NotFoundHttpException('Страница не найденна');
		}
	}

	public function actionUploadAudio()
	{
		if (Yii::$app->request->isPost) {
			$file = UploadedFile::getInstanceByName('audio_data');

			if ($file) {
				if (!file_exists(Yii::getAlias('@web') . 'uploads/messages')) {
					mkdir(Yii::getAlias('@web') . 'uploads/messages', 0777);
				}

				$file->saveAs(Yii::getAlias('@web') . 'uploads/messages/' . $file->name . '.wav');
			}
		}
	}
}
