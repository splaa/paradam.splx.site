<?php


	namespace app\modules\user\controllers;


	use app\modules\services\models\AnswerTheQuestions;
	use app\modules\services\models\OrderService;
	use app\modules\services\models\Service;
	use yii\web\Controller;

	class OrderController extends Controller
	{
		public $layout = false;

		public function actionIndex($id = null)
		{
			if ($id) {
				$id = \Yii::$app->request->get('id');
				$service = Service::findOne($id);
				if (empty($service)) return false;

				$session = \Yii::$app->session;
				$session->open();

				$order = new OrderService();
				$order->addServiceToOrder($service);

				return $this->render('order-modal', compact('session'));
			}

		}

		public function actionAnswerQuestions($id = null)
		{
			$this->view->params['modalTitle'] = 'Ответы на Вопросы';
			\Yii::$app->params['modalTitle'] = 'Ответы на Вопросы';
			if ($id) {
				$id = \Yii::$app->request->get('id');
				$service = Service::findOne($id);
				if (empty($service)) return false;

				$session = \Yii::$app->session;
				$session->open();

				$answer = new AnswerTheQuestions();

//				$order = new OrderService();
//				$order->addServiceToOrder($service);

				return $this->render('answer-the-questions', compact('session', 'service', 'answer'));
			}

		}

		public function actionClear()
		{
			$session = \Yii::$app->session;
			$session->open();
			$session->remove('order');
			$session->remove('order.qty');
			$session->remove('order.sum');
			return $this->render('order-modal', compact('session'));
		}

		public function actionDelItem($id)
		{
			if ($id && !empty($id)) {
				$session = \Yii::$app->session;
				$session->open();
				$order = new OrderService();
				$order->recalc($id);

				return $this->render('order-modal', compact('session'));
			}


		}

		public function actionShow()
		{
			$session = \Yii::$app->session;
			$session->open();

			return $this->render('order-modal', compact('session'));
		}
	}