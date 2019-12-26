<?php
	
	namespace Step\Acceptance;
	
	use AcceptanceTester;
	use Faker\Factory;
	
	class TestUserJoin extends AcceptanceTester
	{
		
		public function imagineUser()
		{
			$faker = Factory::create();
			$user = [
				'name' => $faker->name,
				'email' => $faker->email,
				'password' => $faker->password(4, 7),
			
			];
			return $user;
		}
		
		public function joinUser($user)
		{
			$I = $this;
			$I->amOnPage('/user/join');
			$I->see('Join us');
			
			$I->fillField('UserJoinForm[name]', $user['name']);
			$I->fillField('UserJoinForm[email]', $user['email']);
			$I->fillField('UserJoinForm[password]', $user['password']);
			$I->fillField('UserJoinForm[password2]', $user['password']);
			
			$I->click('Create');
		}
		
		public function loginUser($user)
		{
			$I = $this;
			$I->amOnPage('/user/login');
			$I->see('Log in');
			
			$I->fillField('UserLoginForm[email]', $user['email']);
			$I->fillField('UserLoginForm[password]', $user['password']);
			$I->click('Enter');
		}
		
		public function logoutUser()
		{
			$I = $this;
			$I->click('Logout');
		}
		
		public function isUserLogged($user)
		{
			$I = $this;
			$I->see($user['name']);
		}
		
		public function noUserLogged($user)
		{
			$I = $this;
			$I->dontSee($user['name']);
		}
		
	}