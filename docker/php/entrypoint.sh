#!/bin/sh

set -- php-fpm "$@"

cd /var/www/html/app
php artisan migrate
php artisan db:seed
php artisan serve --host=0.0.0.0 --port=9000

exec "$@"