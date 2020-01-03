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
			return $this->render('index');
		}
	}
