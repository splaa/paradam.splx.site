<?php
// paradam.me.loc/PhoneRecord.php
	
	namespace app\models\customer;
	
	
	use yii\db\ActiveRecord;
	
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
				//пока номер телефона  вводим как строка без формата
				['number', 'string'],
				[['customer_id', 'number'], 'required']
			];
		}
		
	}