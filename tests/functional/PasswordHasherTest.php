<?php
	
	class PasswordHasherTest extends \Codeception\Test\Unit
	{
		/**
		 * @var \FunctionalTester
		 */
		protected $tester;
		
		protected function _before()
		{
		}
		
		protected function _after()
		{
		}
		
		// tests
		public function testSomeFeature()
		{
			$this->assertTrue(true, 'Ошибка False не является  true');
			$userRecord = \app\models\user\UserRecord::findOne(1);
			
			$this->assertEquals("John", $userRecord->name, 'John does not found');
			
		}
	}