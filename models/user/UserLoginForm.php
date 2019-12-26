<?php
// paradam.me.loc/UserLoginForm.php
	
	namespace app\models\user;
	
	
	use Yii;
	use yii\base\Model;
	
	class UserLoginForm extends Model
	{
		public $email;
		public $password;
		/**
		 * @var UserRecord $userRecord
		 */
		private $userRecord;
		
		public function rules()
		{
			return [
				[['email', 'password'], 'required'],
				['email', 'email'],
				['email', 'errorIfEmailNotFound'],
				['password', 'errorIfPasswordWrong']
			];
		}
		
		public function errorIfEmailNotFound()
		{
			if ($this->hasErrors()) return;
			$this->userRecord = $this->getUserByEmail($this->email);
			if ($this->userRecord == null) {
				$this->addError('This e-mail does not registered');
			}
		}
		
		public function errorIfPasswordWrong()
		{
			if ($this->hasErrors()) return;
			if (!$this->userRecord->validatePassword($this->password)) {
				$this->addError('password', 'Wrong password');
			}
		}
		
		public function login()
		{
			if ($this->hasErrors()) return;
			$userIdentity = UserIdentity::findIdentity($this->userRecord->id);
			Yii::$app->user->login($userIdentity);
		}
		
		/**
		 * @param $email
		 * @return UserRecord|null
		 */
		public function getUserByEmail($email): UserRecord
		{
			
			return UserRecord::findUserByEmail($email);
		}
		
	}