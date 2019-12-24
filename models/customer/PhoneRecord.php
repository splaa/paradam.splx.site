<?php
// paradam.me.loc/PhoneRecord.php
	
	namespace app\models\customer;
	
	
	use yii\db\ActiveRecord;
	
	/**
	 * @property  number
	 * @property int $id [int(11)]
	 * @property int $customer_id [int(11)]
	 * @property string $number [varchar(255)]
	 */
	class PhoneRecord extends ActiveRecord
	{
		public static function tableName()
		{
			return 'phone';
		}
		
		public function rules()
		{
			return [
				['customer_id', 'number'],
				['number', 'string'],
				[['customer_id', 'number'], 'required'],
			];
		}
		
	}