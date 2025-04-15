#!/bin/bash
set -e

# Set PostgreSQL SSL mode
export PGSSLMODE=require
export DB_SSLMODE=require

# Clean up cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear

# Run migrations if database is configured
if [ -n "$DATABASE_URL" ] || [ -n "$DB_HOST" ]; then
    echo "Running database migrations..."
    php artisan migrate --force
fi

# Start the PHP server on Render's expected port
echo "Starting Laravel application on ${HOST}:${PORT}"
php artisan serve --host=$HOST --port=$PORT

# If PHP server fails, we'll start nginx as fallback
exec /start.sh