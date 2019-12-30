<?php
	$config = [
		'id' => 'app',
		'defaultRoute' => 'main/default/index',
		'components' => [
			'user' => [
				'identityClass' => 'app\modules\user\models\User',
				'enableAutoLogin' => true,
				'loginUrl' => ['user/default/login'],
			],
			'errorHandler' => [
				'errorAction' => 'main/default/error',
			],
			'request' => [
				'cookieValidationKey' => 'YowPOxrZb2scDDx7JVn7UC4xLmcWfbA1',
			],
			'log' => [
				'traceLevel' => YII_DEBUG ? 3 : 0,
			],
		],
	];
	
	if (YII_ENV_DEV) {
		$config['bootstrap'][] = 'debug';
		$config['modules']['debug'] = [
			'class' => 'yii\debug\Module',
		];
		
		$config['bootstrap'][] = 'gii';
		$config['modules']['gii'] = [
			'class' => 'yii\gii\Module',
		];
	}
	
	return $config;