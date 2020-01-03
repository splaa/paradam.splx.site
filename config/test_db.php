<?php
//	$db = require __DIR__ . '/db.php';
// test database! Important not to run tests on production or development databases
//	$db['dsn'] = 'mysql:host=localhost;dbname=paradam_test';
//
//	return $db;
	
	
	return [
		'class' => 'yii\db\Connection',
		'dsn' => 'mysql:host=127.0.0.1;dbname=paradam_test',
		'username' => 'splaa',
		'password' => 'splaa1977',
		'charset' => 'utf8',
		// Schema cache options (for production environment)
		//'enableSchemaCache' => true,
		//'schemaCacheDuration' => 60,
		//'schemaCache' => 'cache',
	];