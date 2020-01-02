<?php
	
	namespace app\modules\user\controllers;
	
	use app\modules\services\models\Smsc;
	use app\modules\services\models\Telegram;
	use app\modules\user\models\LoginForm;
	use Yii;
	use yii\filters\AccessControl;
	use yii\filters\VerbFilter;
	use yii\web\Controller;
	
	class DefaultController extends Controller
	{
		public function behaviors()
		{
			return [
				'access' => [
					'class' => AccessControl::className(),
					'only' => ['logout'],
					'rules' => [
						[
							'actions' => ['logout'],
							'allow' => true,
							'roles' => ['@'],
						],
					],
				],
				'verbs' => [
					'class' => VerbFilter::className(),
					'actions' => [
						'logout' => ['post'],
					],
				],
			];
		}
		
		public function actionLogin()
		{
			if (!Yii::$app->user->isGuest) {
				return $this->goHome();
			}
			
			$model = new LoginForm();
			if ($model->load(Yii::$app->request->post()) && $model->login()) {
				return $this->goBack();
			} else {
				return $this->render('login', [
					'model' => $model,
				]);
			}
		}
		
		public function actionLogout()
		{
			Yii::$app->user->logout();
			
			return $this->goHome();
		}

		public function actionCode()
		{
			if (Yii::$app->request->post('type') && Yii::$app->request->post('telephone')) {
				switch (Yii::$app->request->post('type')) {
					case 'telegram':
						$code = Yii::$app->security->generateRandomString(4);
						// Send Message to telegram
						$telegram = new Telegram();
						$telegram->telephone = '+' . Yii::$app->request->post('telephone');
						$telegram->message = 'Код для авторизации: ' . $code;
						$telegram->send();
						break;
					case 'call':
						// Send Call Message to User Phone
						$smsc = new Smsc();
						$smsc->telephone = '+' . Yii::$app->request->post('telephone');
						$smsc->message = 'code';
						$code = $smsc->call();
						break;
				}

				Yii::$app->session->set('codeAuth', $code);
				return $this->renderAjax($code);
			}
		}
	}