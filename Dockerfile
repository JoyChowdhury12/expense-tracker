# PHP base
FROM php:8.2-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    unzip curl git libzip-dev sqlite3 libsqlite3-dev \
    && docker-php-ext-install zip pdo pdo_sqlite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working dir
WORKDIR /app

# Copy project
COPY . .

# Create SQLite DB file
RUN mkdir -p database \
    && touch database/database.sqlite

# Set permissions (VERY IMPORTANT)
RUN chmod -R 777 storage bootstrap/cache database

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Run migrations
RUN php artisan migrate --force || true

# Expose port
EXPOSE 10000

# Start server
CMD php artisan serve --host=0.0.0.0 --port=10000