FROM php:7.4-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js 
RUN curl -sL https://unofficial-builds.nodejs.org/download/release/v14.17.0/node-v14.17.0-linux-x64-musl.tar.gz | tar xz -C /usr/local --strip-components=
RUN node -v
RUN npm -v

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install


# Install Node.js dependencies
RUN npm install

# Build assets
RUN npm run prod