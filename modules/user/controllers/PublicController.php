<?php


	namespace app\modules\user\controllers;


	use app\modules\admin\models\UserSearch;
	use app\modules\message\forms\MessageForm;
	use app\modules\services\models\Answer;
	use app\modules\services\models\Comment;
	use app\modules\services\models\Order;
	use app\modules\services\models\Service;
	use app\modules\user\models\Subscribe;
	use app\modules\user\models\User;
	use Yii;
	use yii\base\Model;
	use yii\web\Controller;
	use yii\web\NotFoundHttpException;

	class PublicController extends Controller
	{
		public function actionIndex($username)
		{
			$model = User::findByUsername($username);

			if ($model) {
				$services = Service::find()->where(['user_id' => $model->id])->all();

//---------start splx save модальное окно ответы и коментарий

				$order = new Order();


				$answers = [new Answer()];
				//todo-splaa-serik: Вытащить количество вопросов в выбранной услуге
				for ($i = 1; $i < 10; $i++) {
					$answers[] = new Answer();
				}

				if (Model::loadMultiple($answers, Yii::$app->request->post()) &&
					Model::validateMultiple($answers)) {

					foreach ($answers as $answer) {
						if (null != $answer->answer) {

							$answer->save(false);

							$order->answer_id = $answer->id;
							$order->question_id = $answer->question_id;
						}
					}
				}


				$order->service_id = 1;

				$comment = new Comment();
				if ($comment->load(Yii::$app->request->post()) && $comment->save()) {
					$order->comment_id = (int)$comment->id;
				}
				if ($order->validate()) {

					//todo-splaa-serik: Вытащить id услуги
					$order->service_id = 18;


					$order->user_id = (int)Yii::$app->user->id;
					$order->save(false);

				}
//----------- splx end save модальное окно ответы и коментарий-----------


				$messageForm = new MessageForm();

				if (Yii::$app->user->id != $model->id) {
					// Get ID record subscribe
					$subscriber_id = Yii::$app->user->id;
					$user_id = $model->id;

					$subscribe_info = Subscribe::checkSubscribe($user_id, $subscriber_id);
					$subscribe_id = $subscribe_info['subscribe_id'];
				} else {
					$subscribe_id = 0;
				}

				return $this->render('index', [
					//-------splx start ----------
					'answers' => $answers,
					'comment' => $comment,
					//--------splx end ----------
					'model' => $model,
					'services' => $services,
					'messageForm' => $messageForm,
					'subscribe_id' => $subscribe_id,
					'count' => $subscribe_info['count'] ?? 0,

				]);

			} else {
				throw new NotFoundHttpException('Страница не найденна');
			}
		}

		public function actionList()
		{
			$searchModel = new UserSearch();
			$dataProvider = $searchModel->search([]);

			return $this->render('list', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		}

		public function actionSubscribe()
		{
			if (Yii::$app->request->isAjax && Yii::$app->user->id != Yii::$app->request->post('user_id')) {
				// Get ID record subscribe
				$subscriber_id = Yii::$app->user->id;
				$user_id = Yii::$app->request->post('user_id');
				$subscribe_info = Subscribe::checkSubscribe($user_id, $subscriber_id);

				if (!$subscribe_info['subscribe_id']) {
					$subscribe = new Subscribe();
					$subscribe->subscriber_id = $subscriber_id;
					$subscribe->user_id = $user_id;
					$subscribe->save();

					$subscribe_id = $subscribe->id;
					$subscribe_info = Subscribe::checkSubscribe($user_id, $subscriber_id);
				} else {
					Subscribe::findOne($subscribe_info['subscribe_id'])->delete();
					$subscribe_id = 0;
					$subscribe_info = Subscribe::checkSubscribe($user_id, $subscriber_id);
				}

				return $this->renderAjax('__subscribe_btn_block', [
					'subscribe_id' => $subscribe_id,
					'user_id' => $user_id,
					'count' => $subscribe_info['count']
				]);
			}
		}
	}