<?php

	namespace app\modules\main\controllers;

	use app\modules\user\controllers\UserController;

	/**
	 * Default controller for the `main` module
	 */
	class DefaultController extends UserController
	{
		/**
		 * Renders the index view for the module
		 * @return string
		 */
		public function actionIndex()
		{
			return $this->render('index');
		}
		
		public function actionAbout()
		{
			$message = 'About';
			return $this->render('about', compact('message'));
		}
	}
