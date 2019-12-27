<?php
	
	
	$config = [
		'id' => 'basic-console',
		'controllerNamespace' => 'app\commands',
	];
	
	if (YII_ENV_DEV) {
		// configuration adjustments for 'dev' environment
		$config['bootstrap'][] = 'gii';
		$config['modules']['gii'] = [
			'class' => 'yii\gii\Module',
		];
	}
	
	return $config;
