#!/bin/bash
composer install
pwd
vendor/bin/codecept run acceptance
php yii socket/socket-start > /dev/null 2>&1
php yii socket/socket-start > /dev/null 2>&1