FROM composer:1.10.19 AS composer

# WORKDIR /var/www/html

# COPY composer.* ./

# # Installs all composer packages
# RUN composer install --no-interaction --no-progress --no-suggest --no-scripts --no-dev --no-autoloader


FROM node:14-alpine AS node_builder

RUN mkdir -p /var/www/html
WORKDIR /var/www/html

COPY . ./

# Installs all node packages
RUN npm install 
# 
RUN npm run dev
# Generating static into /var/www/html
RUN npm run prod


FROM php:7.4-fpm-alpine

RUN apk update && apk add bash
RUN set -ex \
    && apk --no-cache add \
    postgresql-dev
RUN docker-php-ext-install pdo pdo_pgsql

# Install Node.js and npm
# RUN apk add --update nodejs npm

# Install nodejs 14 from unofficial repo instead of
# This will not work RUN apk add --no-cache nodejs npm
# RUN wget https://unofficial-builds.nodejs.org/download/release/v14.4.0/node-v14.4.0-linux-x64-musl.tar.xz -P /opt/
# RUN tar -xf /opt/node-v14.4.0-linux-x64-musl.tar.xz -C /opt/
# ENV PATH="$PATH:/opt/node-v14.4.0-linux-x64-musl/bin"

# RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . ./

RUN composer install --no-interaction --no-progress --no-suggest --no-scripts --no-dev --no-autoloader

COPY --from=node_builder /var/www/html/public /var/www/html/public
# COPY --from=composer /var/www/html/vendor /var/www/html/vendor

# RUN chown -R www-data:www-data /var/www/html

CMD bash -c "composer install && \
    php artisan key:generate && \
    php artisan storage:link && \
    chmod 775 -R /var/www/html/storage/ && \
    chown -R www-data:www-data * && \
    php-fpm"