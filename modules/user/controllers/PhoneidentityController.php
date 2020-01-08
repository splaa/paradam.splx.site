<?php
	
	namespace app\modules\user\controllers;
	
	use app\components\Smsc;
	use app\components\Telegram;
	use app\modules\user\forms\PhoneSignupForm;
	use app\modules\user\forms\PhoneSignupVerifyForm;
	use app\modules\user\models\PhoneRecord;
	use Yii;
	use yii\filters\VerbFilter;
	use yii\web\Controller;
	use yii\web\NotFoundHttpException;
	
	/**
	 * UsersController implements the CRUD actions for User model.
	 */
	class PhoneidentityController extends Controller
	{
		/**
		 * {@inheritdoc}
		 */
		public function behaviors()
		{
			return [
				'verbs' => [
					'class' => VerbFilter::className(),
					'actions' => [
						'delete' => ['POST'],
					],
				],
			];
		}
		
		/**
		 * Lists all User models.
		 * @return mixed
		 * @throws \yii\base\Exception
		 */
		public function actionIndex()
		{
			$model = new PhoneSignupForm();
			if ($model->load(Yii::$app->request->post())) {
				if ($user = $model->signup()) {
					Yii::$app->getSession()->setFlash('success', 'Подтвердите ваш телефон.');

					$model = new PhoneSignupVerifyForm();

					return $this->render('verify', [
						'model' => $model,
						'user' => $user
					]);
				}
			}
			
			return $this->render('index', [
				'message' => 'Ok',
				'model' => $model,
			]);
		}

		public function actionVerify($id)
		{
			$model = new PhoneSignupVerifyForm();
			if ($model->load(Yii::$app->request->post())) {
				if ($user = $model->signup($id)) {
					Yii::$app->getSession()->setFlash('success', 'Ваш телефон подтвержден.');
				}
			}

			return $this->goHome();
		}

		public function actionTelephoneCodeConfirm()
		{
			if (Yii::$app->request->post('type') && Yii::$app->request->post('telephone')) {
				switch (Yii::$app->request->post('type')) {
					case 'telegram':
						$code = Yii::$app->security->generateRandomString(4);
						// Send Message to telegram
						$telegram = new Telegram(Yii::$app->request->post('telephone'), 'Код для авторизации: ' . $code);
						$telegram->message();
						break;
					case 'call':
						// Send Call Message to User Phone
						$smsc = new Smsc(Yii::$app->request->post('telephone'));
						$code = $smsc->call();
						break;
					default:
						$code = 0;
						break;
				}

				if ($code) {
					Yii::$app->session->set('codeAuth', $code);
					return 'Телефон подтвержден';
				} else {
					return 'Ошибка повторите позже';
				}
			}
		}
		
		/**
		 * Finds the User model based on its primary key value.
		 * If the model is not found, a 404 HTTP exception will be thrown.
		 * @param integer $id
		 * @return PhoneRecord|null the loaded model
		 * @throws NotFoundHttpException if the model cannot be found
		 */
		protected function findModel($id)
		{
			if (($model = PhoneRecord::findOne($id)) !== null) {
				return $model;
			}
			
			throw new NotFoundHttpException(Yii::t('app', 'Запрашиваемая страница не существует.'));
		}
	}
