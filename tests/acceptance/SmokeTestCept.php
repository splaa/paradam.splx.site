<?php
	/**
	 * @var Scenario $scenario
	 */
	
	use Codeception\Scenario;
	
	$I = new AcceptanceTester($scenario);
	$I->wantTo('Переходим в корень сайта:');
	$I->amOnPage('/');
	$I->see('Paradam', 'h1');
