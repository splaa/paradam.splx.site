<?php

namespace app\commands;

use danog\MadelineProto\API;
use Yii;
use yii\console\Controller;

class TelegramController extends Controller
{

	public function actionRun()
	{
		// Если файл с сессией уже существует, использовать его
		if(file_exists('web/session/session.madeline')) {
			$madeline = new API('web/session/session.madeline');
		} else {
			// Иначе создать новую сессию
			$madeline = new API(Yii::$app->params['api']['tg']);

			// Задать имя сессии
			$madeline->session = 'web/session/session.madeline';

			$madeline->serialize();

			$madeline->phoneLogin(Yii::$app->params['api']['telegram_phone']);

			$code = $madeline->readLine('Enter the code you received: ');

			$madeline->completePhoneLogin($code);
		}
	}
}
