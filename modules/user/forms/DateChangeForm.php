<?php
// paradam.me.loc/PasswordChangeForm.php

namespace app\modules\user\forms;

use app\modules\admin\models\User;
use app\modules\user\Module;
use yii\base\Model;

/**
 * Password reset form
 */
class DateChangeForm extends Model
{
	public $newDate;

	/**
	 * @var User
	 */
	private $_user;

	/**
	 * @param User $user
	 * @param array $config
	 */
	public function __construct(User $user, $config = [])
	{
		$this->_user = $user;
		$this->newDate = date("d.m.Y", strtotime($user->birthday));
		parent::__construct($config);
	}

	public function rules()
	{
		return [
			[['newDate'], 'required'],
		];
	}

	public function attributeLabels()
	{
		return [
			'newDate' => Module::t('app', 'Дата рождения'),
		];
	}

	/**
	 * @return boolean
	 * @throws \yii\base\Exception
	 */
	public function changeDate ()
	{
		if ($this->validate()) {
			$user = $this->_user;
			$user->setDate($this->newDate);
			$user->birthday_change = 1;
			return $user->save();
		} else {
			return false;
		}
	}
}