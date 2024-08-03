FROM php:7.4-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js 14.17.0 and npm 6.14.13
RUN apk add --no-cache curl \
    && curl -fsSL https://deb.nodesource.com/setup_14.x | sh

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install

# Install Node.js dependencies
RUN npm install

# Build assets
RUN npm run production