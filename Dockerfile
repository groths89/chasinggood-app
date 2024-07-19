# Use PHP 8.3
FROM php:8.3-fpm

# Install system dependencies and common php extionsion dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libfreetype-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zlib1g-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Set the working directory
COPY . /var/www/app
WORKDIR /var/www/app

RUN chown -R www-data:www-data /var/www/app \
    && chmod -R 775 /var/www/app/storage

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# copy composer.json to workdir & install dependencies
COPY composer.json ./
RUN composer install

# Expose 8000 to external containers
EXPOSE 8000

# Set the default command to run php-fpm
CMD ["php-fpm"]
