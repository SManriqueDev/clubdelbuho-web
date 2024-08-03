
FROM php:7.4-fpm-alpine

ENV COMPOSER_ALLOW_SUPERUSER=1

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/html

# Set working directory
WORKDIR /var/www/html

RUN docker-php-ext-install pdo_mysql  zip exif pcntl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory contents
COPY . /var/www/html

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]