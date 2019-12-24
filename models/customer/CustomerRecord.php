<?php
// paradam.me.loc/CustomerRecord.php
	
	namespace app\models\customer;
	
	
	use yii\db\ActiveRecord;
	
	/**
	 * @property string name
	 * @property int $id [int(11)]
	 * @property string $birth_date [date]
	 * @property string $notes
	 */
	class CustomerRecord extends ActiveRecord
	{
		public static function tableName()
		{
			return 'customer';
		}
		
		public function rules()
		{
			return [
				['id', 'number'],
				['name', 'required'],
				['name', 'string', 'max' => 256],
				['birth_date', 'date', 'format' => 'Y-m-d'],
				['notes', 'safe']
			];
		}
	}