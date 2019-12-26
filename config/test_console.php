<?php
	return [
		'id' => 'paradam-console',
		'basePath' => dirname(__DIR__),
		'components' => [
			'db' => require(__DIR__ . '/test_db.php'),
		],
	];