<?php
// paradam.me.loc/Customer.php
	
	namespace app\models\customer;
	
	
	use DateTime;
	
	class Customer
	{
		/**
		 * @var string
		 */
		public $name;
		
		/**
		 * @var DateTime
		 */
		public $birth_date;
		
		/**
		 * @var string
		 */
		public $notes = '';
		
		/**
		 * @var array PhoneRecord
		 */
		public $phones = [];
		
		/**
		 * Customer constructor.
		 * @param string $name
		 * @param DateTime $birth_date
		 */
		public function __construct(string $name, DateTime $birth_date)
		{
			$this->name = $name;
			$this->birth_date = $birth_date;
		}
		
		
	}