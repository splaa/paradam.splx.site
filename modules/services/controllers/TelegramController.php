<?php


namespace app\modules\services\controllers;

use danog\MadelineProto;
use danog\MadelineProto\API;
use Yii;


class TelegramController extends ServiceController
{
	public $telephone;
	public $message;

	private $mp;
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

	public function actionMessage()
	{
		$this->telegramConfig['app_info']['api_id'] = isset(Yii::$app->params['api']['tg']['api_id']) ?? 0;
		$this->telegramConfig['app_info']['api_hash'] = isset(Yii::$app->params['api']['tg']['api_hash']) ?? 0;

		$this->mp = new API('session.madeline', $this->telegramConfig);
		$this->mp->start();

		$contact = ['_' => 'inputPhoneContact', 'client_id' => 0, 'phone' => $this->telephone, 'first_name' => '', 'last_name' => ''];
		$import = $this->mp->contacts->importContacts(['contacts' => [$contact]]);

		if (!empty($import['imported'][0]['user_id'])) {
			$this->mp->messages->sendMessage(['peer' => $import['imported'][0]['user_id'], 'message' => $this->message]);

			if ($this->mp->updates->getState()) {
				return 'Сообщение отправленно!';
			} else {
				return 'Ошибка при отправке сообщения!';
			}
		} else {
			return 'Пользователь не найден!';
		}
	}
}