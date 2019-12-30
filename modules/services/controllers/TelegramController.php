<?php

namespace app\modules\services\controllers;

use danog\MadelineProto\API;
use Yii;


class TelegramController extends ServiceController
{
	private $telegramConfig = [
		'authorization' => [
			'default_temp_auth_key_expires_in' => 315576000, // я установил 10 лет, что бы не авторизовывать приложение повторно.
		],
		'app_info' => [ // Эти данные мы получили после регистрации приложения на https://my.telegram.org
			'api_id' => '',
			'api_hash' => '',
		],
		'logger' => [ // Вывод сообщений и ошибок
			'logger' => 3, // выводим сообещения через echo
			'logger_level' => 'FATAL ERROR', // выводим только критические ошибки.
		],
		'max_tries' => [ // Количество попыток установить соединения на различных этапах работы. Лучше не уменьшать, так как телеграм не всегда отвечает с первого раза
			'query' => 5,
			'authorization' => 5,
			'response' => 5,
		],
		'updates' => [ // Я обновляю данные прямыми запросами, поэтому обновления с каналов и чатов мне не требуются.
			'handle_updates' => false,
			'handle_old_updates' => false,
		]
	];

	public function actionIndex()
	{
		if (!file_exists('session/session.madeline')) {
			$this->telegramConfig['app_info']['api_id'] = Yii::$app->params['api']['tg']['api_id'] ?? 0;
			$this->telegramConfig['app_info']['api_hash'] = Yii::$app->params['api']['tg']['api_hash'] ?? 0;

			$mp = new API('lib/session.madeline', $this->telegramConfig);
			$mp->start();
		}
	}
}