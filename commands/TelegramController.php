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
			$madeline = new API([
				'app_info' => [
					'api_id' => Yii::$app->params['api']['tg']['app_info']['api_id'],
					'api_hash' => Yii::$app->params['api']['tg']['app_info']['api_hash'],
				]
			]);

			// Задать имя сессии
			$madeline->session = 'web/session/session.madeline';

			$madeline->serialize();

			$madeline->phoneLogin(Yii::$app->params['api']['telegram_phone']);

			$code = $madeline->readLine('Enter the code you received: ');

			$madeline->completePhoneLogin($code);
		}
	}
}
