<?php
	
	namespace app\modules\main\controllers;

	use yii\web\Controller;
	
	/**
	 * Default controller for the `main` module
	 */
	class DefaultController extends Controller
	{
		public function actions()
		{
			return [
				'error' => [
					'class' => 'yii\web\ErrorAction',
				],
			];
		}
		
		/**
		 * Renders the index view for the module
		 * @return string
		 */
		public function actionIndex()
		{
//			$sms = new Smsc('+380980183456', 'Проверка');
//			$result = $sms->message();
//			echo "<pre>";print_r($result);exit;

//			$sms = new Telegram('+380980183456', 'Проверка');
//			$result = $sms->message();
//			echo "<pre>";print_r($result);exit;

			return $this->render('index');
		}
		
		public function actionAbout()
		{
			$message = 'About';
			return $this->render('about', compact('message'));
		}
	}
