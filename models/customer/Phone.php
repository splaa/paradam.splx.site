<?php
// paradam.me.loc/Phone.php
	
	namespace app\models\customer;
	
	
	class Phone
	{
		/**
		 * @var string
		 */
		public $number;
		
		/**
		 * Phone constructor.
		 * @param string $number
		 */
		public function __construct(string $number)
		{
			$this->number = $number;
		}
		
	}