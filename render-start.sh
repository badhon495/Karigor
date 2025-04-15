#!/bin/bash

# This script handles PostgreSQL SSL connection for Render deployment

echo "Starting Render deployment setup..."

# Set SSL environment variables for PostgreSQL
export PGSSLMODE=require
export DB_SSLMODE=require

# Check if DATABASE_URL is set (Render provides this)
if [ -n "$DATABASE_URL" ]; then
    echo "DATABASE_URL is set, using Render's database connection"
    
    # Make sure the PostgreSQL PHP extension is available
    if php -m | grep -q pdo_pgsql; then
        echo "PostgreSQL PHP extension is available"
    else
        echo "Error: PostgreSQL PHP extension is not available!"
        echo "Please ensure php-pgsql is installed in the deployment environment"
    fi
    
    # Diagnostic check on the database connection
    php -r "
        \$dsn = getenv('DATABASE_URL');
        try {
            \$pdo = new PDO(\$dsn);
            echo \"Database connection successful\\n\";
        } catch (PDOException \$e) {
            echo \"Database connection failed: \" . \$e->getMessage() . \"\\n\";
            echo \"Try setting PGSSLMODE=require or check your credentials\\n\";
        }
    "
fi

# Run the application with Apache (standard for Render PHP apps)
if [ -n "$PORT" ]; then
    echo "Starting Laravel application on PORT $PORT"
    php artisan config:clear
    php artisan cache:clear
    php artisan route:clear
    
    # Run migrations with force flag to avoid prompts
    php artisan migrate --force
    
    # Start the application 
    php artisan serve --host=0.0.0.0 --port=$PORT
else
    echo "Error: PORT environment variable not set"
    exit 1
fi