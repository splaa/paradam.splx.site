<?php
// paradam.me.loc/SignupForm.php
	
	namespace app\modules\user\forms;
	
	use app\modules\user\models\PhoneRecord;
	use app\modules\user\models\User;
	use himiklab\yii2\recaptcha\ReCaptchaValidator2;
	use Yii;
	use yii\base\Model;
	use YoHang88\LetterAvatar\LetterAvatar;

	/**
	 * Signup form
	 */
	class PhoneSignupForm extends Model
	{
		public $username;
		public $email;
		public $telephone;
		public $password;
		public $first_name;
		public $last_name;
		public $birthday;
		public $country;
		public $verifyCodeTelephone;
		public $reCaptcha;

		public function rules()
		{
			return [
				['username', 'filter', 'filter' => 'trim'],
				['username', 'required'],
				['username', 'match', 'pattern' => '#^[\w_-]+$#i'],
				[['username'], 'unique',
					'targetAttribute' => 'username',
					'targetClass' => User::className(),
					'message' => 'Это имя пользователя уже занято.',
				],
				['username', 'string', 'min' => 2, 'max' => 255],
				
				['email', 'filter', 'filter' => 'trim'],
//				['email', 'required'],
				['email', 'email'],
				['email', 'unique', 'targetClass' => User::className(), 'message' => 'This email address has already been taken.'],
				
				['telephone', 'filter', 'filter' => 'trim'],
				['telephone', 'required'],
				['telephone', 'match', 'pattern' => '/^\+380\d{3}\d{2}\d{2}\d{2}$/'],
				['telephone', 'unique', 'targetClass' => PhoneRecord::class, 'message' => 'This telephone address has already been taken.'],
				
				['password', 'required'],
				['password', 'string', 'min' => 8],

				['birthday', 'string'],
				['birthday', 'required'],

				['verifyCodeTelephone', 'required'],
				['verifyCodeTelephone', 'validateVerifyCode'],

				//[['reCaptcha'], ReCaptchaValidator2::className(), 'uncheckedMessage' => 'Please confirm that you are not a bot.'],
			];
		}

		/**
		 * @param $attribute
		 * @param $params
		 */
		public function validateVerifyCode($attribute, $params)
		{
			$codeAuth = Yii::$app->session->get('codeAuth');
			if ($this->$attribute != $codeAuth ) {
				$this->addError($attribute, 'Не верный код подтверждения.');
			}
		}
		
		/**
		 * Signs user up.
		 *
		 * @return User|null the saved model or null if saving fails
		 * @throws \yii\base\Exception
		 */
		public function signup()
		{
			if ($this->validate()) {
				$user = new PhoneRecord();
				$user->username = $this->username;
				$user->email = $this->email;
				$user->telephone = $this->telephone;
				$user->first_name = $this->first_name;
				$user->last_name = $this->last_name;
				$user->birthday = date('Y-m-d',strtotime($this->birthday));
				$user->country = $this->country;
				$user->setPassword($this->password);
				$user->status = User::STATUS_ACTIVE;
				$user->generateAuthKey();
				$user->generateEmailConfirmToken();

				// Generate User Avatar
				$name = $this->username;
				if (!empty($this->last_name)) {
					$name = $this->first_name . ' ' . $this->last_name;
				}

				$avatar = new LetterAvatar($name, 'circle', User::SIZE_AVATAR_SMALL);
				$avatar->saveAs('images/user/avatar/' . $this->username . '-' . User::SIZE_AVATAR_SMALL . '.png');
				$avatar = new LetterAvatar($name, 'square',  User::SIZE_AVATAR_MEDIUM);
				$avatar->saveAs('images/user/avatar/' . $this->username . '-' . User::SIZE_AVATAR_MEDIUM . '.png');
				$avatar = new LetterAvatar($name, 'square', User::SIZE_AVATAR_BIG);
				$avatar->saveAs('images/user/avatar/' . $this->username . '-' . User::SIZE_AVATAR_BIG . '.png');

				$user->avatar = 'images/user/avatar/' .  $this->username;

				
				if ($user->save()) {
					if ($this->email) {
						Yii::$app->mailer->compose(['html' => '@app/modules/user/mails/phoneConfirm'], ['user' => $user])
							->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
							->setTo($this->email)
							->setSubject('Email confirmation for ' . Yii::$app->name)
							->send();
					}
					return $user;
				}
			}
			
			return null;
		}
	}