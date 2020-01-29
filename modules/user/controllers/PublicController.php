<?php


namespace app\modules\user\controllers;


use app\modules\admin\models\UserSearch;
use app\modules\message\forms\MessageForm;
use app\modules\user\models\User;
use yii\web\Controller;

class PublicController extends Controller
{
	public function actionIndex($username)
	{
		$model = User::findByUsername($username);

		if ($model) {
			$messageForm = new MessageForm();

			return $this->render('index', [
				'model' => $model,
				'messageForm' => $messageForm
			]);

		} else {
			throw new NotFoundHttpException('Страница не найденна');
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