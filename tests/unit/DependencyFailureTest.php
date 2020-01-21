<?php
// paradam.me.loc/DependencyFailureTest.php
	namespace unit;
	
	use PHPUnit\Framework\TestCase;
	
	class DependencyFailureTest extends TestCase
	{
		public function testOne(): void
		{
			$this->assertTrue(true);
		}
		
		/**
		 * @depends testOne
		 */
		public function testTwo(): void
		{
		
		}
	}
