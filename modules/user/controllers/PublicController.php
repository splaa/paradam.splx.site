<?php


namespace app\modules\user\controllers;


use app\modules\admin\models\UserSearch;
use app\modules\user\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PublicController extends Controller
{
	public function actionIndex($username)
	{
		$model = User::findByUsername($username);

		if ($model) {
			return $this->render('index', [
				'model' => $model
			]);
		} else {
			throw new \yii\web\NotFoundHttpException('Страница не найденна');
		}
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