<?php
	return [
		'id' => 'paradam',
		'basePath' => realpath(__DIR__ . '/../'),
		'components' => [
			'request' => [
				'cookieValidationKey' => 'paradam^2019_1h3jhg3j3gvx', // используется для remember me
				'enableCookieValidation' => 'false', // false выключает аунтефикацию через cookies
			],
		]
	];