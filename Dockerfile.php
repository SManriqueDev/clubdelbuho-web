FROM composer as builder
WORKDIR /var/www/html
COPY composer.* ./
RUN composer install

FROM php:7.4-fpm-alpine
# Set working directory
WORKDIR /var/www/html

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Copy existing application directory permissions
COPY --from=builder /var/www/html/vendor /var/www/html/vendor

# Copy existing application directory contents
COPY . .


