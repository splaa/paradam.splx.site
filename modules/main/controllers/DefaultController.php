<?php
	
	namespace app\modules\main\controllers;
	
	use app\modules\services\controllers\TelegramController;
	use app\modules\services\models\Smsc;
	use app\modules\services\models\Telegram;
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
			// Send Message to telegram
			$telegram = new Telegram();
			$telegram->telephone = '+380980183456';
			$telegram->message = 'TEST2 with composer';
			$telegram->send();
//
//			// Send Call Message to User Phone
//			$smsc = new Smsc();
//			$smsc->telephone = '+380980183456';
//			$smsc->message = '1234';
//			$smsc->call();


			return $this->render('index');
		}
	}
