FROM php:7.4-fpm-alpine


WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

ENV COMPOSER_ALLOW_SUPERUSER=1



COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY ./composer.json ./composer.lock ./
COPY . .

RUN composer install --no-interaction --no-dev --prefer-dist --no-scripts --no-progress

COPY . .

RUN composer dump-autoload --optimize

RUN chown -R www-data:www-data storage && \
    chmod -R 775 storage
