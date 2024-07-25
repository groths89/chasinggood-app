# Stage 1: Build environment (non-persistent)
FROM php:8.3-alpine AS builder-php

# INSTALL COMPOSER
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

WORKDIR /app

# Copy Laravel application code (Including the composer.json file)
COPY . .

# Install Node.js and npm (for Vite)
RUN apk add --no-cache nodejs npm

# Install project dependencies
RUN npm install

# Run the install step for Composer
RUN composer install --no-dev

# PHP-specific build steps (e.g., artisan commands)
RUN php artisan migrate

# Build assets with Vite
RUN npm run build

# Stage 2: Install Python and get Supervisor
FROM python:3.10-slim-buster AS builder-python

WORKDIR /app

# Copy application code from builder stage
COPY --from=builder-php /app /app

# Install additional packages if needed
RUN pip install -r requirements.txt
RUN pip install supervisor

# Stage 3: Run Laravel application (slim image)
FROM nginx:stable-alpine AS nginx

# Copy application code from builder-python stage
COPY --from=builder-python /app/public /var/www/html/public

# Expose ports (adjust based on your Laravel application)
EXPOSE 80

# Copy configuration files
COPY supervisord.conf /etc/supervisord.conf
COPY nginx.conf /etc/nginx/conf.d/default.conf
COPY php-fpm.conf /etc/php/8.3/fpm/php-fpm.conf

# Start Supervisor
CMD ["/usr/bin/supervisord", "-n"]
