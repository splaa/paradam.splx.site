<?php

	namespace app\modules\services\controllers;

	use app\modules\services\models\ImageUpload;
	use app\modules\services\models\Service;
	use app\modules\services\models\ServiceSearch;
	use app\modules\user\controllers\UserController;
	use Yii;
	use yii\filters\VerbFilter;
	use yii\web\NotFoundHttpException;
	use yii\web\UploadedFile;

	/**
	 * ServiceController implements the CRUD actions for Service model.
	 */
	class ServiceController extends UserController
	{
		/**
		 * {@inheritdoc}
		 */
		public function behaviors()
		{
			return yii\helpers\ArrayHelper::merge(parent::behaviors(), [
				'verbs' => [
					'class' => VerbFilter::className(),
					'actions' => [
						'delete' => ['POST'],
					],
				],
			]);
		}

		/**
		 * Lists all Service models.
		 * @return mixed
		 */
		public function actionIndex()
		{
			$searchModel = new ServiceSearch();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		}

		/**
		 * Displays a single Service model.
		 * @param integer $id
		 * @return mixed
		 * @throws NotFoundHttpException if the model cannot be found
		 */
		public function actionView($id)
		{
			return $this->render('view', [
				'model' => $this->findModel($id),
			]);
		}

		/**
		 * Creates a new Service model.
		 * If creation is successful, the browser will be redirected to the 'view' page.
		 * @return mixed
		 */
		public function actionCreate()
		{
			$model = new Service();
			$modelImage = new ImageUpload();

			if (Yii::$app->request->isPost) {
				$model->imageFile = UploadedFile::getInstance($model, 'imageFile');

				if (!is_null($model->imageFile)) {

					$model->saveImage($modelImage->uploadFile($model->imageFile, $model->link_foto_video_file));

				}


				$model->user_id = Yii::$app->user->id;
				if ($model->load(Yii::$app->request->post()) && $model->save()) {


					return $this->redirect(['/services/question/create', 'id' => $model->id]);
				}


			}


			return $this->render('create', [
				'model' => $model,
			]);
		}

		/**
		 * Updates an existing Service model.
		 * If update is successful, the browser will be redirected to the 'view' page.
		 * @param integer $id
		 * @return mixed
		 * @throws NotFoundHttpException if the model cannot be found
		 */
		public function actionUpdate($id)
		{
			$model = $this->findModel($id);
			$model->user_id = Yii::$app->user->id;
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				return $this->redirect(['view', 'id' => $model->id]);
			}

			return $this->render('update', [
				'model' => $model,
			]);
		}

		/**
		 * Deletes an existing Service model.
		 * If deletion is successful, the browser will be redirected to the 'index' page.
		 * @param integer $id
		 * @return mixed
		 * @throws NotFoundHttpException if the model cannot be found
		 * @throws \Throwable
		 * @throws \yii\db\StaleObjectException
		 */
		public function actionDelete($id)
		{
			$this->findModel($id)->delete();

			return $this->redirect(['index']);
		}

		/**
		 * Finds the Service model based on its primary key value.
		 * If the model is not found, a 404 HTTP exception will be thrown.
		 * @param integer $id
		 * @return Service the loaded model
		 * @throws NotFoundHttpException if the model cannot be found
		 */
		protected function findModel($id)
		{
			if (($model = Service::findOne($id)) !== null) {
				return $model;
			}

			throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
		}

		public function actionSetImage($id)
		{
			$model = new ImageUpload();
			if (Yii::$app->request->isPost) {

				$service = $this->findModel($id);

				$file = UploadedFile::getInstance($model, 'image');

				if (!is_null($file)) {
					if ($service->saveImage($model->uploadFile($file, $service->link_foto_video_file))) {
						return $this->redirect(['view', 'id' => $service->id]);
					}

				}


			}

			return $this->render('image', compact('model'));
		}
	}
