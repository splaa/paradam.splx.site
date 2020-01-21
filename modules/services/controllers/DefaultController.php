<?php

namespace app\modules\services\controllers;

use app\modules\services\models\ServiceSearch;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `services` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
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
}
