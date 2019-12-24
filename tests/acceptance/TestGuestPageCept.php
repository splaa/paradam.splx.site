<?php
	/**
	 * @var Scenario $scenario
	 */
	
	use Codeception\Scenario;
	
	$I = new AcceptanceTester($scenario);
	$I->wantTo('Открывает home/join/login страницы');
	
	$I->amOnPage('/');
	$I->see("Welcome", 'h1');
	$I->seeLink("Join", "/user/join");
	$I->seeLink("Login", "/user/login");
	
	$I->amOnPage('/user/join');
	$I->see('Join us', 'h1');
	$I->amOnPage('/user/login');
	$I->see('Log in', 'h1');
