#!/bin/sh

chmod -R 777 storage/
php artisan cache:clear
php artisan key:generate