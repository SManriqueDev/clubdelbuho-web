FROM php:7.4-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

ENV COMPOSER_ALLOW_SUPERUSER=1

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


COPY ./composer.json ./composer.lock ./
COPY . .


RUN composer install --no-interaction --no-dev --prefer-dist --no-scripts --no-progress

COPY . .

RUN composer dump-autoload --optimize

RUN addgroup -g 1000 www-data && \
    adduser -u 1000 -G www-data -s /bin/sh -D www-data

COPY --chown=www-data:www-data . .

USER www-data
