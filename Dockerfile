# Use official PHP 8.4 CLI image
FROM php:8.4-cli

# Set working directory
WORKDIR /var/www/html

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
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy composer files first for better caching
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# Copy rest of application (ensure public directory is included)
COPY . .

# Verify public/css/style.css exists
RUN ls -la public/css/style.css || echo "WARNING: style.css not found!"

# Generate optimized autoload files
RUN composer dump-autoload --optimize --no-dev

# Create storage directories and set permissions
RUN mkdir -p storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache/data \
    storage/logs \
    bootstrap/cache \
    public/storage \
    && chmod -R 777 storage bootstrap/cache public/storage

# Create storage symlink
RUN php artisan storage:link || true

# Ensure all public assets are accessible
RUN chmod -R 755 public

# Expose port
EXPOSE 8000

# Create startup script
RUN echo '#!/bin/bash\n\
set -e\n\
echo "Starting application..."\n\
echo "Verifying public assets..."\n\
ls -la public/css/style.css || echo "ERROR: style.css missing!"\n\
echo "Creating storage link..."\n\
php artisan storage:link || true\n\
echo "Running migrations..."\n\
php artisan migrate --force || true\n\
echo "Starting server on port ${PORT:-8000}..."\n\
exec php artisan serve --host=0.0.0.0 --port=${PORT:-8000} --no-reload' > /start.sh \
    && chmod +x /start.sh

# Start application
CMD ["/start.sh"]
