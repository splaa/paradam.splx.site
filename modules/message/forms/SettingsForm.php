<?php


namespace app\modules\message\forms;


use app\modules\admin\models\User;
use yii\base\Model;

class SettingsForm extends Model
{
	public $sms_cost;


	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['sms_cost', 'required'],
			['sms_cost', 'number', 'min' => 1],
		];
	}

	public function attributeLabels()
	{
		return [
			'sms_cost' => 'Стоимость одного с ообщения'
		];
	}

	public function changeSmsCost()
	{
		$user = User::findOne(\Yii::$app->user->id);
		$user->sms_cost = $this->sms_cost;

		return $user->save();
	}
}