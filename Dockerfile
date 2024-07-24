# Stage 1: Build environment (non-persistent)
FROM php:8.3-alpine AS builder

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
RUN apk add php81-extensions-bcmath php81-extensions-mbstring php81-extensions-openssl php81-extensions-pdo_mysql

# Configure PHP-FPM (adjust as needed)
COPY php-fpm.conf /etc/php/7/fpm/php-fpm.conf

# Run PHP-FPM in the foreground
CMD ["php-fpm7", "-F"]