#!/bin/bash

cd /var/www/html/

composer install --no-scripts

php artisan migrate
php artisan queue:work &

npm install --verbose && npm run build

php-fpm
