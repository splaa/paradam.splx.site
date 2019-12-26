<?php
// paradam.me.loc/UserController.php
	
	namespace app\controllers;
	
	
	use app\models\user\UserJoinForm;
	use app\models\user\UserLoginForm;
	use app\models\user\UserRecord;
	use Yii;
	use yii\web\Controller;
	
	class UserController extends Controller
	{
		
		public function actionJoin()
		{
			if (Yii::$app->request->isPost) {
				return $this->actionJoinPost();
			}
			$userJoinForm = new UserJoinForm();
			$userRecord = new UserRecord();
			$userRecord->setTestUser();
			$userJoinForm->setUserRecord($userRecord);
			
			return $this->render('join', compact('userJoinForm'));
		}
		
		public function actionJoinPost()
		{
			$userJoinForm = new UserJoinForm();
			if ($userJoinForm->load(Yii::$app->request->post())) {
				if ($userJoinForm->validate()) {
					$user = new UserRecord();
					$user->setUserJoinForm($userJoinForm);
					$user->save();
					//  TODO: можно перенаправить на страницу Благодарим за регистрацию
					return $this->redirect('/user/login/');
				}
			}
			return $this->render('join', compact('userJoinForm'));
		}
		
		public function actionLogin()
		{

//			$uid = UserIdentity::findIdentity(1);
//			Yii::$app->user->login($uid);
			$userLoginForm = new UserLoginForm();
//			$userLoginForm->email = 'test@example.com';
			return $this->render('login', compact('userLoginForm'));
		}
		
		public function actionLogout()
		{
			Yii::$app->user->logout();
			return $this->redirect('/');
		}
		
	}