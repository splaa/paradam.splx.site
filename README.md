
#  [ссылка: Инструкция по Google cloud](https://docs.google.com/document/d/144eI2NVO05XxZ2xTOvmInJeOlf5XHTP8Zyuvw5gIDD8/edit?usp=sharing)





# Скачуем docker image 
docker pull yiisoftware/yii-php:7.4-apache

//  в случае ошибок — они будут указаны
docker-compose up 

//или запуск в фоне
docker-compose up -d  

//посмотреть список запущенных контейнеров можно так
docker ps  								

//После запуска контейнера можно выполнить команду, чтобы обновить composer

docker-compose run --rm php 
docker exec -it d7a2456b68cc bash  		// если нужно войти в контейнер по хешу смотрим docker ps. Вход происходит под root
docker exec -it docker_app_1 bash 		// Подключаемся к контейнеру по имени смотрим docker ps

cd /app && composer install
cd /app && composer update
mkdir /app/runtime && mkdir /app/web/assets

php init

cp config/common-docker.php.example config/common-local.php

//	Выполняем команду миграции БД php 
/app/yii migrate

//	Создаем папку для логов 
// если логируем в эту папку
mkdir /app/log

// И выходим 
exit

//Тормозим сервис
docker-compose down

// Запускаем его заново 
docker-compose up -d
=======
# Скачуем docker image на комп 
docker pull yiisoftware/yii-php:7.4-apache

//  в случае ошибок — они будут указаны
docker-compose up 

//запуск в фоне
docker-compose up -d  

//посмотреть список запущенных контейнеров
docker ps  								

//После запуска контейнера можно выполнить команду, чтобы обновить composer

docker-compose run --rm php 

docker exec -it d7a2456b68cc bash  		// если нужно войти в контейнер по хешу. Вход происходит под root
docker exec -it docker_app_1 bash 		// Подключаемся к контейнеру по имени

cd /app && composer install
cd /app && composer update
mkdir /app/runtime && mkdir /app/web/assets
php init

cp config/common-docker.php.example config/common-local.php

//	Выполняем команду миграции БД php 
/app/yii migrate

//	Создаем папку для логов 
// если логируем в эту папку
mkdir /app/log

// И выходим 
exit

//Тормозим сервис
docker-compose down

// Запускаем его заново 
docker-compose up -d


http://examle.com:8000 - site
http://examle.com:8888 - adminer
db host=mysql
port = 3336
login = splaa
pass = splaa1977

