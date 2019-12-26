<?php
	$db = require __DIR__ . '/db.php';
	$db['dsn'] = 'mysql:host=localhost;dbname=paradam_test';
//	return $db;
	return [
		'class' => '\yii\db\Connection',
		'dsn' => 'mysql:host=127.0.0.1;dbname=paradam_test',
		'username' => 'splaa',
		'password' => 'splaa1977'
	];