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
		
		public function rules()
		{
			return [
				[['name', 'email', 'password', 'password2'], 'required'],
				['name', 'string', 'min' => 3, 'max' => 8],
				['email', 'email'],
				['password', 'string', 'min' => 4],
				['password2', 'compare', 'compareAttribute' => 'password']
			
			];
		}
		
	}