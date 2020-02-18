FROM yiisoftware/yii-php:7.4-apache
USER root

RUN apt-get update && apt-get install -y openssh-server apache2 supervisor
RUN mkdir -p /var/lock/apache2 /var/run/apache2 /var/run/sshd /var/log/supervisor

RUN mkdir /var/log/telegram/
RUN mkdir /var/log/websocket/
COPY conf.d/supervisord.conf /etc/supervisor/supervisord.conf
COPY conf.d/telegram_api_server.conf /etc/supervisor/conf.d/telegram_api_server.conf
COPY conf.d/websocket_server.conf /etc/supervisor/conf.d/websocket_server.conf
RUN a2enmod ssl
RUN a2ensite default-ssl
COPY conf.d/server.pem /etc/ssl/certs/ssl-cert-snakeoil.pem
COPY conf.d/server.key /etc/ssl/private/ssl-cert-snakeoil.key
RUN service apache2 reload 

EXPOSE 80
EXPOSE 443
EXPOSE 9503
EXPOSE 9505
