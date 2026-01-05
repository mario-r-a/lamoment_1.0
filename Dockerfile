# Use official PHP 8.4 FPM image as base
FROM php:8.4-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . /var/www

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Set proper permissions for Laravel
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache

# Expose port (Railway will set this via PORT env variable)
EXPOSE 8000

# Create entrypoint script for Railway
RUN echo '#!/bin/sh\n\
php artisan config:cache\n\
php artisan route:cache\n\
php artisan view:cache\n\
php artisan migrate --force\n\
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}' > /entrypoint.sh \
    && chmod +x /entrypoint.sh

# Start Laravel application
CMD ["/entrypoint.sh"]
