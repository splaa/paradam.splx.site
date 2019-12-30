<?php

namespace app\modules\services\models;

use danog\MadelineProto\API;
use Yii;
use yii\base\Model;

class Telegram extends Model
{
	public $telephone = '+380980183456';
	public $message = 'Test';

	public function send()
	{
		if (file_exists('session/session.madeline')) {
			$mp = new API('session/session.madeline');
			$mp->start();

			$contact = ['_' => 'inputPhoneContact', 'client_id' => 0, 'phone' => $this->telephone, 'first_name' => '', 'last_name' => ''];
			$import = $mp->contacts->importContacts(['contacts' => [$contact]]);

			if (!empty($import['imported'][0]['user_id'])) {
				$mp->messages->sendMessage(['peer' => $import['imported'][0]['user_id'], 'message' => $this->message]);

				if ($mp->updates->getState()) {
					return Yii::t('ServicesTelegram','Сообщение отправленно!');
				} else {
					return Yii::t('ServicesTelegram','Ошибка при отправке сообщения!');
				}
			} else {
				return Yii::t('ServicesTelegram','Пользователь не найден!');
			}
		} else {
			return Yii::t('ServicesTelegram','Сессия не найдена!');
		}
	}
}