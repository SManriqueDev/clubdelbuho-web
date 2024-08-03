FROM php:7.4-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY . .

# Install Composer dependencies
RUN composer install

RUN composer dump-autoload --optimize


# Expose port 9000 for the PHP-FPM server
EXPOSE 8000

# Run the application
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]