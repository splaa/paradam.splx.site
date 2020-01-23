<?php


namespace app\modules\user\controllers;


use app\modules\admin\models\UserSearch;
use app\modules\user\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PublicController extends Controller
{
	public function actionIndex($id)
	{
		$model = User::findOne($id);

		return $this->render('index', [
			'model' => $model
		]);
	}

	public function actionList()
	{
		$searchModel = new UserSearch();
		$dataProvider = $searchModel->search([]);

		return $this->render('list', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}
}