<?php
	
	namespace app\modules\user\controllers;
	
	use app\modules\user\forms\PhoneSignupForm;
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
					Yii::$app->getSession()->setFlash('success', 'Подтвердите ваш тедлефон.');
					return $this->goHome();
				}
			}
			
			return $this->render('index', [
				'message' => 'Ok',
				'model' => $model,
			]);
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
