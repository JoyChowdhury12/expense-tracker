FROM php:8.2-cli

# Install system dependencies + PostgreSQL support
RUN apt-get update && apt-get install -y \
    unzip curl git libzip-dev libpq-dev \
    && docker-php-ext-install zip pdo pdo_pgsql pgsql

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy project
COPY . .

# Permissions
RUN chmod -R 777 storage bootstrap/cache

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port
EXPOSE 10000

# Start app (with proper cache handling)
CMD sh -c "php artisan config:clear && php artisan cache:clear && php artisan config:cache && php artisan migrate:fresh --force && php artisan serve --host=0.0.0.0 --port=10000"