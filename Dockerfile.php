
FROM php:7.4-fpm-alpine

RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN mkdir -p /var/www/html
RUN chown -R laravel:laravel /var/www/html

# Set working directory
WORKDIR /var/www/html

COPY . .
RUN docker-php-ext-install pdo pdo_mysql
RUN chown -R laravel:laravel /var/www/html

USER laravel

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]