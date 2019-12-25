<?php
	/**
	 * @var $scenario Scenario
	 */
	
	use Codeception\Scenario;
	use Step\Acceptance\TestUserJoin;
	
	$I = new TestUserJoin($scenario);
	$I->wantTo('Регистрация и Вход Новых пользователей ');
	
	$user1 = $I->imagineUser();
	$user2 = $I->imagineUser();
	
	$I->loginUser($user1);
	$I->see("This e-mail does not registered");
	
	$I->joinUser($user1);
	$I->joinUser($user2);
	
	
	$I->joinUser($user1);
	$I->see("This e-mail already exists");
	
	$I->loginUser($user1);
	$I->isUserLogged($user1);
	$I->noUserLogged($user2);
	$I->logoutUser();
	
	$I->loginUser($user2);
	$I->isUserLogged($user2);
	$I->noUserLogged($user1);
	$I->logoutUser();
	
	
	$user1['password'] = 'wrong password';
	$I->loginUser($user1);
	$I->see('Wrong password');
	
	
	
