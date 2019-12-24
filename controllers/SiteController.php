<?php
// paradam.me.loc/SiteController.php
	
	namespace app\controllers;
	
	
	use yii\web\Controller;
	
	class SiteController extends Controller
	{
		public function actionIndex()
		{
			$message = 'Welcome';
			return $this->render('index', compact('message'));
		}
		
		
	}