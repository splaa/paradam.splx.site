<?php
	
	namespace app\modules\user\models;
	
	use Yii;
	use yii\base\Model;
	use yii\db\ActiveRecord;

	/**
	 * @property mixed auth_key
	 * @property mixed id
	 * @property mixed login
	 * @property mixed password
	 * @property mixed telephone
	 * @property mixed first_name
	 * @property mixed last_name
	 * @property mixed email
	 * @property mixed birthday
	 */

	class User extends ActiveRecord implements \yii\web\IdentityInterface
	{
		public static function tableName()
		{
			return 'user';
		}
		
		/**
		 * {@inheritdoc}
		 */
		public static function findIdentity($id)
		{
			return static::findOne($id);
		}
		
		/**
		 * {@inheritdoc}
		 */
		public static function findIdentityByAccessToken($token, $type = null)
		{
			//return static::findOne(['access_token' => $token]);
		}
		
		/**
		 * Finds user by username
		 *
		 * @param string $username
		 * @return static|null
		 */
		public static function findByUsername($username)
		{
			return static::findOne(['username' => $username]);
		}

		/**
		 * Finds user by username
		 *
		 * @param string $telephone
		 * @return static|null
		 */
		public static function findByTelephone($telephone)
		{
			return static::findOne(['telephone' => $telephone]);
		}
		
		/**
		 * {@inheritdoc}
		 */
		public function getId()
		{
			return $this->id;
		}
		
		/**
		 * {@inheritdoc}
		 */
		public function getAuthKey()
		{
			return $this->auth_key;
		}
		
		/**
		 * {@inheritdoc}
		 */
		public function validateAuthKey($authKey)
		{
			return $this->auth_key === $authKey;
		}
		
		/**
		 * Validates password
		 *
		 * @param string $password password to validate
		 * @return bool if password provided is valid for current user
		 */
		public function validatePassword($password)
		{
			return Yii::$app->security->validatePassword($password, $this->password);
		}

		/**
		 * @throws \yii\base\Exception
		 */
		public function generateAuthKey()
		{
			$this->auth_key = Yii::$app->security->generateRandomString();
		}
	}
