#!/bin/sh

set -- php-fpm "$@"

cd /var/www/html/app
php artisan migrate --force
php artisan db:seed --force
php artisan serve --host=0.0.0.0 --port=9000

exec "$@"