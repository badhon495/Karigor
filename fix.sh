#!/bin/bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
composer dump-autoload
php artisan optimize:clear
php artisan migrate:fresh
php artisan serve