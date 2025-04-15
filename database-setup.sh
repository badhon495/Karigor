#!/bin/bash

# This script sets up the database connection for Render deployment

# Install required PostgreSQL PHP extensions if not already installed
if ! php -m | grep -q pdo_pgsql; then
    echo "Installing PostgreSQL PHP extensions..."
    if [ -f /etc/debian_version ]; then
        # For Debian/Ubuntu
        apt-get update && apt-get install -y php-pgsql
    elif [ -f /etc/alpine-release ]; then
        # For Alpine (which Render might use)
        apk add --no-cache php-pgsql
    fi
fi

# Configure SSL certificate path if needed
if [ ! -z "$DATABASE_URL" ]; then
    echo "Setting up database configuration..."
    # Parse the DATABASE_URL from Render environment
    DB_HOST=$(echo $DATABASE_URL | awk -F[@/:] '{print $4}')
    DB_PORT=$(echo $DATABASE_URL | awk -F[@/:] '{print $5}')
    DB_NAME=$(echo $DATABASE_URL | awk -F[@/:] '{print $6}')
    DB_USER=$(echo $DATABASE_URL | awk -F[@/:] '{print $3}' | cut -d':' -f1)
    DB_PASS=$(echo $DATABASE_URL | awk -F[@/:] '{print $3}' | cut -d':' -f2)
    
    # Update environment variables
    export DB_CONNECTION=pgsql
    export DB_HOST=$DB_HOST
    export DB_PORT=$DB_PORT
    export DB_DATABASE=$DB_NAME
    export DB_USERNAME=$DB_USER
    export DB_PASSWORD=$DB_PASS
    export DB_SSLMODE=require
fi

# Run Laravel database migrations
echo "Running database migrations..."
php artisan migrate --force

echo "Database setup complete."