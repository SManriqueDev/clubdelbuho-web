#!/bin/sh

# Install dependencies and run initial setup
composer install
npm install
npm run "$ENVIRONMENT"
php artisan key:generate
php artisan config:cache
php artisan migrate
php artisan storage:link
chmod 775 -R /var/www/html/storage/
chown -R www-data:www-data *

# Conditionally run database seeding based on environment
if [ "$ENVIRONMENT" = "development" ]; then
  echo "Running database seeder in development environment"
  php artisan migrate:fresh --seed
else
  php artisan migrate:fresh --seed
fi

# Start PHP-FPM
php-fpm