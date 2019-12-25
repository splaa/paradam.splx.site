<?php
// paradam.me.loc/UserJoinForm.php
	
	namespace app\models\user;
	
	
	use yii\base\Model;
	
	class UserJoinForm extends Model
	{
		public $name;
		public $email;
		public $password;
		public $password2;
		
	}