#!/bin/bash

chmod 777 -R /var/www/storage
composer install
php artisan key:generate
php artisan migrate
php-fpm
