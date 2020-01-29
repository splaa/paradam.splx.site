<?php


namespace app\modules\message\forms;


use app\modules\admin\models\User;
use yii\base\Model;

class MessageForm extends Model
{
	public $text;


	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['text', 'required'],
		];
	}

	public function attributeLabels()
	{
		return [
			'text' => 'Ваше сообщзение'
		];
	}
}