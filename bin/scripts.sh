#!/usr/bin/env bash
sed -i "s#DocumentRoot /var/www/html#DocumentRoot /var/www#g" /etc/apache2/sites-available/000-default.conf
