<?php
// paradam.me.loc/UserRecord.php
	
	namespace app\models\user;
	
	
	use Faker\Factory;
	use yii\db\ActiveRecord;
	
	/**
	 * @property string name
	 * @property int $id [int(11)]
	 * @property string $email [varchar(255)]
	 * @property string $passhash [varchar(255)]
	 * @property UserJoinForm $userJoinForm
	 * @property int $status [int(11)]
	 */
	class UserRecord extends ActiveRecord
	{
		public static function tableName()
		{
			return 'user';
		}
		
		public static function findUserByEmail($email)
		{
			return static::findOne(['email' => $email]);
		}
		
		public function rules()
		{
			return [
				['name', 'string'],
				['email', 'string'],
				['passhash', 'string'],
			
			];
		}
		
		public function setTestUser()
		{
			$faker = Factory::create();
			$this->name = $faker->name;
			$this->email = $faker->email;
			$this->passhash = $faker->password(3, 6);
			$this->status = 2;
		}
		
		/**
		 * @param $email
		 * @return bool
		 */
		public static function existsEmail($email)
		{
			$count = static::find()->where(['email' => $email])->count();
			return $count > 0;
		}
		
		public function setUserJoinForm(UserJoinForm $userJoinForm)
		{
			$this->name = $userJoinForm->name;
			$this->email = $userJoinForm->email;
			$this->passhash = $userJoinForm->password;
			//todo: Определить в params define ACCAUNT_STATUS_ статусы (подтверждённый неподтвержденный
			$this->status = 1;
		}
		
	}