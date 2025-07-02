#!/usr/bin/env bash
echo "Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --working-dir=/var/www/html
echo "Running Laravel migrations..."
php artisan migrate --force
