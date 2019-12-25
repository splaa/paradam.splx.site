<?php
// paradam.me.loc/UserController.php
	
	namespace app\controllers;
	
	
	use app\models\user\UserIdentity;
	use app\models\user\UserJoinForm;
	use app\models\user\UserRecord;
	use Yii;
	use yii\web\Controller;
	
	class UserController extends Controller
	{
		
		public function actionJoin()
		{
			$userRecord = new UserRecord();
			$userRecord->setTestUser();
			$userRecord->save();
			$userJoinForm = new UserJoinForm();
			return $this->render('join', compact('userJoinForm'));
		}
		
		public function actionLogin()
		{
			
			$uid = UserIdentity::findIdentity(1);
			Yii::$app->user->login($uid);
			return $this->render('login');
		}
		
	}