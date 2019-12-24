<?php
	return [
		'id' => 'paradam',
		'basePath' => realpath(__DIR__ . '/../'),
		'controllerNamespace' => 'app\controllers',
//		'aliases' => [
//			'@bower' => '@vendor/bower-asset',
//			'@npm'   => '@vendor/npm-asset',
//		],
		'components' => [
			'request' => [
				'cookieValidationKey' => 'paradam^2019_1h3jhg3j3gvx', // используется для remember me
				'enableCookieValidation' => 'false', // false выключает аунтефикацию через cookies
			],
		
		]
	];