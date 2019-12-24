<?php
	/**
	 * @var Scenario $scenario
	 */
	
	use Codeception\Scenario;
	use Step\Acceptance\CRMOperatorSteps;
	use Step\Acceptance\CRMUserSteps;
	
	$I = new CRMOperatorSteps($scenario);
	$I->wantTo('Добавить двух разных клиентов в базу данных:');
	
	$I->amInAddCustomerUi();
	
	$first_customer = $I->imagineCustomer();
	
	$I->fillCustomerDataForm($first_customer);
	$I->submitCustomerDataForm();
	
	$I->seeIAmInListCustomersUi();
	
	$I->amInAddCustomerUi();
	$second_customer = $I->imagineCustomer();
	$I->fillCustomerDataForm($second_customer);
	$I->submitCustomerDataForm();
	
	$I->seeIAmInListCustomersUi();
	
	$I = new CRMUserSteps($scenario);
	$I->wantTo('запросить информацию о клиенте, используя его номер телефона');
	
	$I->amInQueryCustomerUi();
	$I->fillInPhonefieldWhithDataForm($first_customer);
	$I->clickSearchButton();
	
	$I->seeIAmInListCustomersUi();
	$I->seeCustomerInList($first_customer);
	$I->dontSeeCustomerInList($second_customer);
