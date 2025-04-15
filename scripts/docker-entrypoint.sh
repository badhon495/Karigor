#!/bin/bash
set -e

cd /var/www/html

# Check if vendor directory exists, if not install dependencies
if [ ! -d "/var/www/html/vendor" ]; then
    echo "Installing dependencies..."
    composer install --no-interaction --optimize-autoloader --no-dev
fi

# Set PostgreSQL SSL mode
export PGSSLMODE=require
export DB_SSLMODE=require

# Storage permissions
mkdir -p /var/www/html/storage/framework/{sessions,views,cache}
chmod -R 775 /var/www/html/storage
chown -R nginx:nginx /var/www/html/storage

# Clean up cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear

# Generate application key if not set
if [ -z "$APP_KEY" ]; then
    echo "Generating application key..."
    php artisan key:generate --force
fi

# Run migrations if database is configured
if [ -n "$DATABASE_URL" ] || [ -n "$DB_HOST" ]; then
    echo "Running database migrations..."
    php artisan migrate --force
fi

# Start the PHP server
echo "Starting Laravel application on ${HOST}:${PORT}"
php artisan serve --host=$HOST --port=$PORT

# If PHP server fails, we'll start nginx as fallback
exec /start.sh