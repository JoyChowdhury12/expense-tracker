FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    unzip curl git libzip-dev sqlite3 libsqlite3-dev \
    && docker-php-ext-install zip pdo pdo_sqlite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN mkdir -p database \
    && touch database/database.sqlite

RUN chmod -R 777 storage bootstrap/cache database

RUN composer install --no-dev --optimize-autoloader

EXPOSE 10000

CMD php artisan config:clear && \
    php artisan cache:clear && \
    php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=10000