<?php
// paradam.me.loc/SignupVerifyForm.php
	
	namespace app\modules\user\forms;
	
	use app\modules\user\models\PhoneIdentity;
	use app\modules\user\models\User;
	use Yii;
	use yii\base\Model;
	
	/**
	 * Signup form
	 */
	class PhoneSignupVerifyForm extends Model
	{
		public $telephone;
		public $verifyCode;
		public $model;
		
		public function rules()
		{
			return [
				['telephone', 'filter', 'filter' => 'trim'],
				['telephone', 'match', 'pattern' => '/^\+380\d{3}\d{2}\d{2}\d{2}$/'],

				[['telephone', 'verifyCode'], 'required'],

				['verifyCode', 'validateVerifyCode'],
			];
		}

		public function getModel()
		{
			if (!$this->model) {
				$this->model = new User();
			}
			return $this->model;
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
		 * @param $user_id
		 * @return User|null
		 * @throws \Throwable
		 * @throws \yii\db\StaleObjectException
		 */
		public function signup($user_id)
		{
			if ($this->validate()) {
				$user = User::findOne($user_id);
				$user->telephone = $this->telephone;
				$user->status = User::STATUS_ACTIVE;

				if ($user->update()) {
					return $user;
				}
			}
			
			return null;
		}
	}