<?php
	
	class FirstCest
	{
		public function _before(AcceptanceTester $I)
		{
		}
		
		// tests
		public function tryToTest(AcceptanceTester $I)
		{
			$I->wantTo('Переходим в корень сайта:');
			$I->amOnPage('/');
			$I->see('Paradam', 'h1');
		}
	}
