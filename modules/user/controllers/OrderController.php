<?php


	namespace app\modules\user\controllers;


	use app\modules\services\models\AnswerTheQuestions;
	use app\modules\services\models\Comment;
	use app\modules\services\models\OrderService;
	use app\modules\services\models\Service;
	use Yii;
	use yii\web\Controller;

	class OrderController extends Controller
	{

		public function actionIndex($id = null)
		{
			$this->layout = false;
			if ($id) {
				$id = Yii::$app->request->get('id');
				$service = Service::findOne($id);
				if (empty($service)) return false;

				$session = Yii::$app->session;
				$session->open();

				$order = new OrderService();
				$order->addServiceToOrder($service);

				return $this->render('order-modal', compact('session'));
			}
			return;
		}

		public function actionAnswerQuestions($id = null)
		{
			$this->layout = false;
			$this->view->params['modalTitle'] = 'Ответы на Вопросы';
			Yii::$app->params['modalTitle'] = 'Ответы на Вопросы';
			if ($id) {
				$id = Yii::$app->request->get('id');
				$service = Service::findOne($id);
				if (empty($service)) return false;

				$session = Yii::$app->session;
				$session->open();

				$answer = new AnswerTheQuestions();
				$comment = new Comment();

//				$order = new OrderService();
//				$order->addServiceToOrder($service);

				return $this->render('answer-the-questions',
					compact('session', 'service', 'answer', 'comment'));
			}

		}

		public function actionClear()
		{
			$this->layout = false;

			$session = Yii::$app->session;
			$session->open();
			$session->remove('order');
			$session->remove('order.qty');
			$session->remove('order.sum');
			return $this->render('order-modal', compact('session'));
		}

		public function actionDelItem($id)
		{
			$this->layout = false;
			if ($id && !empty($id)) {
				$session = Yii::$app->session;
				$session->open();
				$order = new OrderService();
				$order->recalc($id);

				return $this->render('order-modal', compact('session'));
			}


		}

		public function actionShow()
		{
			$this->layout = false;
			$session = Yii::$app->session;
			$session->open();

			return $this->render('order-modal', compact('session'));
		}
	}