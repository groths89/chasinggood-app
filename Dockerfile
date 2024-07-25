# Stage 1: Build environment (non-persistent)
FROM php:8.3-alpine AS builder

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
RUN composer install --no-dev --ignore-platform-reqs

# Build assets with Vite
RUN npm run build

# Stage 2: Run Laravel application (slim image)
FROM nginx:stable-alpine

# Copy application code from builder stage
COPY --from=builder /app/public .

# Expose ports (adjust based on your Laravel application)
EXPOSE 80

# Copy Nginx configuration
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Start Nginx
CMD ["nginx", "-g", "daemon off;"]