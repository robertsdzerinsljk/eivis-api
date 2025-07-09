# Dockerfile (projekta saknē)
FROM php:8.1-cli

RUN apt-get update \
 && apt-get install -y libzip-dev zip unzip git \
 && docker-php-ext-install pdo_mysql zip

# Composer no oficiālā image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN php artisan key:generate

EXPOSE 8000
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port ${PORT:-8000}"]
