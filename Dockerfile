FROM php:7.4-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# setup node js source will be used later to install node js
RUN curl -sL https://deb.nodesource.com/setup_14.x -o nodesource_setup.sh
RUN ["sh",  "./nodesource_setup.sh"]

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install

# Install Node.js dependencies
RUN npm install

# Build assets
RUN npm run prod