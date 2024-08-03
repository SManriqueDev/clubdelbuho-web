FROM composer:2.5 as composer

WORKDIR /var/www/html

COPY ./composer.json ./composer.lock ./
# Copy the database folder content before running composer install
COPY ./database /var/www/html/database
RUN composer install --no-interaction --no-dev --prefer-dist --no-scripts --no-progress

FROM php:7.4-fpm-alpine

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

ENV COMPOSER_ALLOW_SUPERUSER=1

COPY --from=composer /var/www/html/vendor/ /var/www/html/vendor/
COPY --chown=www-data:www-data . /var/www/html


RUN chown -R www-data:www-data /var/www/html/storage && \
    chmod -R 775 /var/www/html/storage

RUN composer dump-autoload --optimize