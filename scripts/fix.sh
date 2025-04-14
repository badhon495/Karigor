#!/bin/bash

echo "Starting database fix..."
php artisan migrate:fresh

echo "Running migrations..."
php artisan migrate --force 

echo "Clearing application cache..."
php artisan cache:clear

# Clear configuration cache
echo "Clearing configuration cache..."
php artisan config:clear

# Clear route cache
echo "Clearing route cache..."
php artisan route:clear

# Clear compiled view cache
echo "Clearing compiled view cache..."
php artisan view:clear

# Regenerate Composer autoloader
echo "Dumping Composer autoload..."
composer dump-autoload

# Clear compiled optimization cache
echo "Clearing compiled optimization cache..."
php artisan optimize:clear

echo "Laravel caches cleared successfully."

# echo "\nChecking contact_issues table structure:"
# php artisan db:table contact_issues

echo "Running the server..."
php artisan serve