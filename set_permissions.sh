#!/bin/sh

chmod -R 777 storage/
php artisan cache:clear
RUN php artisan key:generate