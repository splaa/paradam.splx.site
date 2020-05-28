<?php
	
	namespace app\modules\user\controllers;
	
	use app\components\Smsc;
    use app\components\Telegram;
    use app\modules\user\forms\PhoneSignupForm;
	use app\modules\user\models\PhoneRecord;
	use Yii;
    use yii\filters\VerbFilter;
	use yii\helpers\Html;
	use yii\helpers\Url;
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
//			$this->view->registerJsFile('@web/js/phone-codes.js');

			$model = new PhoneSignupForm();

			if (Yii::$app->request->isAjax) {
				if ($model->load(Yii::$app->request->post()) && $model->validate()) {
					return $this->asJson(['success' => true]);
				}

				$result = [];
				// The code below comes from ActiveForm::validate(). We do not need to validate the model
				// again, as it was already validated by save(). Just collect the messages.
				foreach ($model->getErrors() as $attribute => $errors) {
					$result[Html::getInputId($model, $attribute)] = $errors;
				}

				return $this->asJson(['validation' => $result]);
			}

			if ($model->load(Yii::$app->request->post())) {
				if ($user = $model->signup()) {
					Yii::$app->getSession()->setFlash('success', 'Ваш аккаунт успешно создан.');

					return $this->redirect(Url::to('/user/default/phonelogin'));
				}
			}
			
			return $this->render('index', [
				'message' => 'Ok',
				'model' => $model,
			]);
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
