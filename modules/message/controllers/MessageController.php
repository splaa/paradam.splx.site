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
use yii\helpers\Url;
use YoHang88\LetterAvatar\LetterAvatar;

/**
 * Default controller for the `message` module
 */
class MessageController extends UserController
{
	/**
	 * @param string $id
	 * @return string
	 * @throws \yii\base\InvalidConfigException
	 */
	public function actionIndex($id = '')
	{
		$this->view->registerCssFile('@web/css/chat.css');

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
		
		return $this->render('index', [
			'threads' => $threads,
			'selected_user_thread' => $selected_user_thread
		]);
	}

	public function actionSettings()
	{
		$model = new SettingsForm();

		if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->changeSmsCost()) {
			Yii::$app->getSession()->setFlash('success', 'Спасибо! Стоимость сообщения изменена.');

			return $this->refresh();
		}

		return $this->render('settings', [
			'model' => $model
		]);
	}

	public function actionCreate()
	{
		if (Yii::$app->request->isPost || Yii::$app->request->isAjax) {
			$model = new MessageForm();

			if ($model->load(Yii::$app->request->post()) && $model->validate()) {
				$author_id = Yii::$app->user->id;
				$user_id = Yii::$app->request->post('user_id');
				$text = $model->text;

				$thread = Thread::find()->alias('t')
					->innerJoin('user_thread as ut1', 't.id = ut1.thread_id')
					->innerJoin('user_thread as ut2', 't.id = ut2.thread_id')
					->where(['ut1.user_id' => $author_id, 'ut2.user_id' => $user_id])
					->orWhere(['ut1.user_id' => $user_id, 'ut2.user_id' => $author_id])
					->groupBy('t.id')
					->asArray()
					->one();

				if ($thread) {
					$thread_id = $thread['id'];
				} else {
					$thread = new Thread();
					$thread->title = $author_id . '=>' . $user_id;
					$thread->save();
					$thread_id = $thread->id;

					$user_thread = new UserThread();
					$user_thread->user_id = $user_id;
					$user_thread->thread_id = $thread_id;
					$user_thread->save();
				}


				$message = new Message();
				$message->author_id = $author_id;
				$message->thread_id = $thread_id;
				$message->text = $text;
				$message->save();

				$user_message = new UserMessage();
				$user_message->user_id = $author_id;
				$user_message->message_id = $message->id;
				$user_message->save();


				$hash = new Hash();
				$hash->string = $thread_id;

				return $this->redirect(Url::to(['index', 'id' => $hash->run(Hash::ENCODE)]));
			} else {
				return 'Ошибка';
			}
		}
	}
}
