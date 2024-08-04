FROM composer:1.10.19 AS composer
FROM php:7.4-fpm-alpine

ARG ENVIRONMENT=development
ENV ENVIRONMENT=$ENVIRONMENT

RUN apk update && apk add bash
RUN set -ex \
    && apk --no-cache add \
    postgresql-dev
RUN docker-php-ext-install pdo pdo_pgsql pdo_mysql

# Install nodejs 14 from unofficial repo instead of
# This will not work RUN apk add --no-cache nodejs npm
RUN wget https://unofficial-builds.nodejs.org/download/release/v14.4.0/node-v14.4.0-linux-x64-musl.tar.xz -P /opt/
RUN tar -xf /opt/node-v14.4.0-linux-x64-musl.tar.xz -C /opt/
ENV PATH="$PATH:/opt/node-v14.4.0-linux-x64-musl/bin"

# RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . ./

RUN composer install --no-interaction --no-progress --no-suggest --no-scripts --no-dev --no-autoloader

# Copy entrypoint script
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
# Set permissions for entrypoint script
RUN chmod +x /usr/local/bin/entrypoint.sh

# Set entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
# CMD bash -c "composer install && \
#     npm install && \
#     npm run " . $ENVIRONMENT . " && \
#     php artisan key:generate && \
#     php artisan config:cache && \
#     php artisan migrate && \
#     php artisan db:seed && \
#     php artisan storage:link && \
#     chmod 775 -R /var/www/html/storage/ && \
#     chown -R www-data:www-data * && \
#     php-fpm"