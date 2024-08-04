FROM php:7.4-fpm-alpine

# Add laravel user and group
RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel

# Create necessary directories and set permissions
RUN mkdir -p /var/www/html \
    && chown -R laravel:laravel /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Copy Composer from the official Composer image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Composer dependencies
RUN composer install --no-interaction --no-dev --optimize-autoloader

# Copy application files
COPY . .

# Set permissions for application files
RUN chown -R laravel:laravel /var/www/html

# Switch to laravel user
USER laravel

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]