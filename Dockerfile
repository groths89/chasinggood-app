# Stage 1: Build environment (non-persistent)
FROM php:8.3-alpine AS builder

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

# Install dependencies
COPY composer.json composer.lock ./
RUN composer install --prefer-dist

# Copy Laravel application code
COPY . .

# Build Laravel application (optional)
RUN php artisan compile  # Adjust commands as needed

# Stage 2: Run Laravel application (slim image)
FROM nginx:stable-alpine

# Copy application code from builder stage
COPY --from=builder /app /var/www/html

# Expose ports (adjust based on your Laravel application)
EXPOSE 8000

# Install PHP extensions (optional)
RUN apk add php83-extensions-bcmath php83-extensions-mbstring php83-extensions-openssl php83-extensions-pdo_mysql

# Configure PHP-FPM (adjust as needed)
COPY php-fpm.conf /etc/php/7/fpm/php-fpm.conf

# Run PHP-FPM in the foreground
CMD ["php-fpm7", "-F"]