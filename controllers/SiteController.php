<?php
// paradam.me.loc/SiteController.php
	
	namespace app\controllers;
	
	
	use yii\web\Controller;
	
	class SiteController extends Controller
	{
		public function actionIndex()
		{
			$records = $this->findRecordsByQuery();
			return $this->render('index', compact('records'));
		}
	}