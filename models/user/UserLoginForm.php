<?php
// paradam.me.loc/UserLoginForm.php
	
	namespace app\models\user;
	
	
	use Yii;
	use yii\base\Model;
	
	class UserLoginForm extends Model
	{
		public $email;
		public $password;
		
		public function rules()
		{
			return [
				[['email', 'password'], 'required'],
				['email', 'email'],
				['email', 'errorIfEmailNotFound'],
				['password', 'errorIfPasswordWrong']
			];
		}
		
		public function errorIfPasswordWrong()
		{
			if ($this->hasErrors()) {
				return;
			}
			$userRecord = UserRecord::findUserByEmail($this->email);
			if ($userRecord->passhash !== $this->password) {
				$this->addError('password', 'Wrong password');
			}
		}
		
		public function errorIfEmailNotFound()
		{
			$userRecord = UserRecord::findUserByEmail($this->email);
			if ($userRecord->email !== $this->email) {
				$this->addError('This e-mail does not registered');
			}
		}
		
		public function login()
		{
			if ($this->hasErrors()) {
				return;
			}
			$userRecord = UserRecord::findUserByEmail($this->email);
			$userIdentity = UserIdentity::findIdentity($userRecord->id);
			Yii::$app->user->login($userIdentity);
		}
		
	}