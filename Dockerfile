# Stage 1: Build environment (non-persistent)
#FROM php:8.3-fpm-alpine AS builder-php

# INSTALL PHP83
# RUN apk update
# RUN apk add openrc php83 php83-fpm

# INSTALL COMPOSER
# RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
#    php composer-setup.php && \
#    php -r "unlink('composer-setup.php');" && \
#    mv composer.phar /usr/local/bin/composer

# WORKDIR /app

# Copy Laravel application code (Including the composer.json file)
# COPY . .

# Install Node.js and npm (for Vite)
# RUN apk add --no-cache nodejs npm

# Install project dependencies
# RUN npm install

# Run the install step for Composer
# RUN composer install --no-dev

# PHP-specific build steps (e.g., artisan commands)
# RUN php artisan migrate

# Build assets with Vite
# RUN npm run build

# Add a volume for php-fpm
# VOLUME /etc/php83/
# VOLUME /usr/sbin/php-fpm

# Stage 2: Run Laravel application (slim image)
# FROM nginx:stable-alpine AS nginx

# INSTALL SUPERVISOR
# RUN apk update
# RUN apk add --no-cache supervisor
# RUN mkdir -p /var/log/supervisor

# Copy application code from builder-python stage
# COPY --from=builder-php /app/public /var/www/html/public

# Expose ports (adjust based on your Laravel application)
# EXPOSE 80

# Copy configuration files
# COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
# COPY nginx.conf /etc/nginx/conf.d/default.conf
# COPY php-fpm.conf /etc/php83/fpm/php-fpm.conf

# Start Supervisor
# CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

# APACHE Dockerfile
FROM php:8.2.2-apache-buster

RUN apt-get update && \
    apt-get install nano zip unzip wget git locales locales-all libcurl4-openssl-dev libjpeg-dev libpng-dev libzip-dev pkg-config libssl-dev -y && \
    docker-php-ext-install pdo_pgsql bcmath

RUN docker-php-ext-configure gd \
    && docker-php-ext-install gd \
    && docker-php-ext-enable gd

RUN docker-php-ext-configure zip \
    && docker-php-ext-install zip

# set document root to public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# enable rewrite module for htaccess
RUN a2enmod rewrite

# COPY THE SOURCE CODE TO DOCUMENT WEB ROOT
WORKDIR /var/www/html/
COPY . .


# INSTALL COMPOSER
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

# UPDATE DEPENDENCIES
RUN composer install

RUN /usr/local/bin/composer require phpoffice/phpspreadsheet
RUN /usr/local/bin/composer require aws/aws-sdk-php


# ALLOW WEB SERVER (www-data) TO WRITE TO THESE LOG DIRECTORY
RUN chown -R www-data:www-data /var/www/html/storage
RUN chown -R www-data:www-data /var/www/html/bootstrap/cache

ENV LC_ALL en_US.UTF-8
ENV LANG en_US.UTF-8
ENV LANGUAGE en_US.UTF-8

RUN a2enmod rewrite

COPY ./.docker/vhost.conf /etc/apache2/sites-available/000-default.conf
