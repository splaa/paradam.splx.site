<?php
// paradam.me.loc/UserJoinForm.php
	
	namespace app\models\user;
	
	
	use yii\base\Model;
	
	/**
	 *
	 * @property UserRecord $userRecord
	 */
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
				['name', 'string', 'min' => 3, 'max' => 30],
				['email', 'email'],
				['password', 'string', 'min' => 4],
				['password2', 'compare', 'compareAttribute' => 'password'],
				['name', 'errorIfName'],
				['email', 'errorIfEmailUsed']
			
			];
		}
		
		public function errorIfName()
		{
			//Добавляем ошибку если при вводе в Форму Имя Admin
			if ($this->name == 'Admin')
				$this->addError('name', 'No name pleas');
		}
		
		public function errorIfEmailUsed()
		{
			if ($this->hasErrors()) return;
			
			if (UserRecord::existsEmail($this->email)) {
				$this->addError('email', "This e-mail already exists");
				return;
			}
		}
		
		public function setUserRecord(UserRecord $userRecord)
		{
			$this->name = $userRecord->name;
			$this->email = $userRecord->email;
			$this->password2 = $this->password = 'qwas';
			
			
		}
		
	
		
	}