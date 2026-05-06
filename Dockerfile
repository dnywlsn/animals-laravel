FROM php:8.2-cli

WORKDIR /app

# system deps
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql

# composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000
