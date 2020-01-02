<?php

namespace app\modules\services\controllers;

use danog\MadelineProto\API;
use Yii;


class TelegramController extends ServiceController
{
	public function actionIndex()
	{
		$mp = new API('session/session.madeline', Yii::$app->params['api']['tg']);
		$mp->start();
	}
}