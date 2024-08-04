FROM php:7.4-fpm-alpine

ENV COMPOSER_ALLOW_SUPERUSER 1

# Install dependencies
RUN apk add --update nodejs npm \
    && docker-php-ext-install pdo pdo_mysql

# Add laravel user and group
RUN addgroup -g 1000 laravel \
    && adduser -G laravel -g laravel -s /bin/sh -D laravel

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Set permissions for application files
RUN chown -R laravel:laravel /var/www/html

# Install Composer and dependencies
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-dev --optimize-autoloader

# Install Node dependencies and build assets
COPY package.json ./
RUN npm ci --only=production
RUN npm run production

# Generate application key
RUN php artisan key:generate

# Clear cache
RUN php artisan cache:clear

# Set permissions for storage and bootstrap/cache
RUN chmod -R 777 storage/

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]