<?php

namespace app\modules\message\controllers;

use app\modules\message\models\UserThread;
use app\modules\user\controllers\UserController;
use yii\web\Controller;

/**
 * Default controller for the `message` module
 */
class MessageController extends UserController
{
	/**
	 * Renders the index view for the module
	 * @return string
	 */
	public function actionIndex()
	{
		$this->view->registerCssFile('@web/css/chat.css');


		$threads = UserThread::findAll(['user_id' => \Yii::$app->user->getId()]);
		
		return $this->render('index', [
			'threads' => $threads
		]);
	}

	public function actionGetThreadMessage($threads_id) {

	}
}
