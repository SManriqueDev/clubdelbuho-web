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
RUN wget https://unofficial-builds.nodejs.org/download/release/v14.4.0/node-v14.4.0-linux-x64-musl.tar.xz -P /opt/
RUN tar -xf /opt/node-v14.4.0-linux-x64-musl.tar.xz -C /opt/
ENV PATH="$PATH:/opt/node-v14.4.0-linux-x64-musl/bin"

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-scripts

# Install Node.js dependencies and build assets
RUN npm install
RUN npm run production


RUN chown -R www-data:www-data /var/www/html

CMD bash -c "composer install && npm install && npm run prod && php artisan key:generate && php-fpm"