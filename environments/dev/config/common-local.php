<?php
// paradam.me.loc/common-local.php

return [
    'components' => [
        'reCaptcha' => [
            'class' => 'himiklab\yii2\recaptcha\ReCaptchaConfig',
            'siteKeyV2' => '6LcNSc4UAAAAAFFThKjbampM1PhXIfFzcQPTWfXl',
            'secretV2' => '6LcNSc4UAAAAAIO62wRroEo5ffqwYaT1cNIQ9mkI',
            'siteKeyV3' => '',
            'secretV3' => '',
        ],
        'db' => [
//				host=mysql // название контейгера в docker-compose.yml
            'dsn' => 'mysql:host=mysql;dbname=paradam',
            'username' => 'splaa',
            'password' => 'splaa1977',
//				'tablePrefix' => 'keys_',
        ],
        'mailer' => [
            'useFileTransport' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];