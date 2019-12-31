<?php
	
	return [
		'adminEmail' => '',
		'supportEmail' => '',
		'supportName' => '',
		'senderEmail' => '',
		'senderName' => '',

		'api' => [
			'tg' => [
				'api_id' => '257313',
				'api_hash' => 'ff458dd210d0e2d278d802b87da8d3cb'
			],
			'smsc' => [
				'login' => 'yprabota@gmail.com', // логин клиента
				'password' => '47Pdm,47', // пароль
				'post' => '', // использовать метод POST
				'https' => '', // использовать HTTPS протокол
				'charset' => 'utf-8', // кодировка сообщения: utf-8, koi8-r или windows-1251 (по умолчанию)
				'debug' => 0, // флаг отладки
				'from' => 'api@smsc.ua' // e-mail адрес отправителя
			]
		]
	];
