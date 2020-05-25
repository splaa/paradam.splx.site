<?php
	
	namespace app\modules\user\controllers;
	
	
	use app\modules\user\forms\EmailConfirmForm;
    use app\modules\user\forms\LoginForm;
    use app\modules\user\forms\PasswordResetForm;
    use app\modules\user\forms\PasswordResetRequestForm;
    use app\modules\user\forms\PhoneLoginForm;
    use app\modules\user\forms\SignupForm;
    use app\modules\user\Module;
    use Yii;
    use yii\base\InvalidParamException;
    use yii\filters\AccessControl;
    use yii\filters\VerbFilter;
    use yii\web\BadRequestHttpException;
    use yii\web\Controller;

    class DefaultController extends Controller
    {
        /**
         * @var Module
         */
        public $module;

        public function behaviors()
        {
            return [
                'access' => [
					'class' => AccessControl::className(),
					'only' => ['logout'],
//					'only' => ['logout', 'signup'],
					'rules' => [
//						[
//							'actions' => ['signup'],
//							'allow' => true,
//							'roles' => ['?'],
//						],
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
		
		public function actions()
		{
			return [
				'captcha' => [
					'class' => 'yii\captcha\CaptchaAction',
					'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
				],
			];
		}
		
		public function actionIndex()
		{
			return $this->redirect(['profile/index'], 301);
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
					'model' => $model
				]);
			}
		}
		
		public function actionPhonelogin()
		{
			if (!Yii::$app->user->isGuest) {
				return $this->goHome();
			}
			
			$model = new PhoneLoginForm();
			
			if ($model->load(Yii::$app->request->post()) && $model->login()) {
				
				return $this->goBack();
			} else {
				$show_captcha = false;
				if (Yii::$app->request->isPost) {
					if (Yii::$app->session->get('loginCount')) {
						if (Yii::$app->session->get('loginCount') >= PhoneLoginForm::LOGIN_COUNT_LIMIT) {
							$show_captcha = true;
						} else {
							Yii::$app->session->set('loginCount', Yii::$app->session->get('loginCount') + 1);
						}
					} else {
						Yii::$app->session->set('loginCount', 1);
					}
				}

				return $this->render('phonelogin', [
					'model' => $model,
					'show_captcha' => $show_captcha
				]);
			}
		}

		public function actionPhoneForgotten()
		{
			if (!Yii::$app->user->isGuest) {
				return $this->goHome();
			}

			$this->view->registerJsFile('@web/js/phone-codes.js');

			$model = new PhoneLoginForm();

			if ($model->load(Yii::$app->request->post()) && $model->login()) {
				return $this->goBack();
			} else {
				$show_captcha = false;
				if (Yii::$app->request->isPost) {
					if (Yii::$app->session->get('loginCount')) {
						if (Yii::$app->session->get('loginCount') >= PhoneLoginForm::LOGIN_COUNT_LIMIT) {
							$show_captcha = true;
						} else {
							Yii::$app->session->set('loginCount', Yii::$app->session->get('loginCount') + 1);
						}
					} else {
						Yii::$app->session->set('loginCount', 1);
					}
				}

				return $this->render('forgotten', [
					'model' => $model,
					'show_captcha' => $show_captcha
				]);
			}
		}
		
		public function actionLogout()
		{
			Yii::$app->user->logout();
			
			return $this->goHome();
		}
		
		public function actionSignup()
		{
			$model = new SignupForm();
			if ($model->load(Yii::$app->request->post())) {
				if ($user = $model->signup()) {
					Yii::$app->getSession()->setFlash('success', 'Подтвердите ваш электронный адрес.');
					return $this->goHome();
				}
			}
			
			return $this->render('signup', [
				'model' => $model,
			]);
		}
		
		public function actionEmailConfirm($token)
		{
			try {
				$model = new EmailConfirmForm($token);
			} catch (InvalidParamException $e) {
				throw new BadRequestHttpException($e->getMessage());
			}
			
			if ($model->confirmEmail()) {
				Yii::$app->getSession()->setFlash('success', 'Спасибо! Ваш Email успешно подтверждён.');
			} else {
				Yii::$app->getSession()->setFlash('error', 'Ошибка подтверждения Email.');
			}
			
			return $this->goHome();
		}
		
		public function actionPasswordResetRequest()
		{
			$model = new PasswordResetRequestForm($this->module->passwordResetTokenExpire);;
			if ($model->load(Yii::$app->request->post()) && $model->validate()) {
				if ($model->sendEmail()) {
					Yii::$app->getSession()->setFlash('success', 'Спасибо! На ваш Email было отправлено письмо со ссылкой на восстановление пароля.');
					
					return $this->goHome();
				} else {
					Yii::$app->getSession()->setFlash('error', 'Извините. У нас возникли проблемы с отправкой.');
				}
			}
			
			return $this->render('passwordResetRequest', [
				'model' => $model,
			]);
		}
		
		public function actionPasswordReset($token)
		{
			try {
				$model = new PasswordResetForm($token, $this->module->passwordResetTokenExpire);;
			} catch (InvalidParamException $e) {
				throw new BadRequestHttpException($e->getMessage());
			}
			
			if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
				Yii::$app->getSession()->setFlash('success', 'Спасибо! Пароль успешно изменён.');
				
				return $this->goHome();
			}
			
			return $this->render('passwordReset', [
				'model' => $model,
			]);
		}
	}