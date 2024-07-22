#!/bin/sh

set -- php-fpm "$@"

cd /var/www/html/app
php artisan migrate --force
php artisan db:seed --force

exec "$@"