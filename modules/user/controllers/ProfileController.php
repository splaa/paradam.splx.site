<?php
// paradam.me.loc/ProfileController.php
	
	namespace app\modules\user\controllers;
	
	
	use app\modules\user\models\User;
	use yii\filters\AccessControl;
	use yii\web\Controller;
	
	class ProfileController extends Controller
	{
		public function behaviors()
		{
			return [
				'access' =>[
					'class' => AccessControl::className(),
					'rules' => [
						[
							'allow' =>true,
							'roles' =>['@']
						],
					],
				],
			];
		}
		
		public function actionIndex()
		{
			return $this->render('index', [
				'model' => $this->findModel(),
			]);
		}
		
		private function findModel()
		{
			return User::findOne(\Yii::$app->user->identity->getId());
		}
		
		
		
		public function actionUpdate()
		{
			$model = $this->findModel();
			$model->scenario = User::SCENARIO_PROFILE;
			
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				return $this->redirect(['index']);
			} else {
				return $this->render('update', [
					'model' => $model,
				]);
			}
		}
		
		
	}