
FROM php:7.4-fpm-alpine

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PHP_UID=1000
ENV PHP_GID=1000

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN docker-php-ext-install pdo pdo_mysql
RUN mkdir -p /var/www/html/storage/framework/{sessions,views,cache} \
    && mkdir -p /var/www/html/bootstrap/cache \
    && mkdir -p /var/www/html/storage/logs \
    && addgroup -g ${PHP_UID} www \
    && adduser -H -D -u ${PHP_GID} -G www www \
    && chown -R www:www /var/www/html \
    && chmod -R 775 /var/www/html/storage

WORKDIR /var/www/html
USER www

COPY . .

RUN composer install --no-interaction --no-dev --prefer-dist --no-scripts --no-progress
RUN composer dump-autoload --optimize
