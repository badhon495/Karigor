# Deploying to Render with PostgreSQL

This guide will help you deploy your Laravel application to Render with a PostgreSQL database.

## Prerequisites

1. Create a [Render](https://render.com) account if you haven't already
2. Push your code to a GitHub or GitLab repository

## Step 1: Create a PostgreSQL Database

1. In the Render dashboard, go to "New" and select "PostgreSQL"
2. Configure your database:
   - Name: `karigor-db` (or your preferred name)
   - PostgreSQL Version: 15 (recommended)
   - Region: Choose closest to your users
   - Instance Type: Start with Free tier for testing
3. Click "Create Database"
4. Note the connection details provided by Render:
   - Database
   - User
   - Password
   - Internal Database URL
   - External Database URL

## Step 2: Create a Web Service

1. In the Render dashboard, go to "New" and select "Web Service"
2. Connect your GitHub/GitLab repository
3. Configure your web service:
   - Name: `karigor` (or your preferred name)
   - Runtime: PHP
   - Build Command: `composer install && npm install && npm run build && php artisan migrate --force`
   - Start Command: `php artisan serve --host 0.0.0.0 --port $PORT`
   - Instance Type: Start with a free instance for testing
   
4. Add the following environment variables:
   - `APP_ENV`: `production`
   - `APP_KEY`: Use your existing app key or generate one with `php artisan key:generate --show`
   - `APP_DEBUG`: `false`
   - `APP_URL`: Will be your Render URL (e.g., `https://karigor.onrender.com`)
   - `DATABASE_URL`: Use the Internal Database URL from your PostgreSQL service
   - `DB_CONNECTION`: `pgsql`
   - `LOG_CHANNEL`: `stderr`
   - `CACHE_DRIVER`: `database`
   - `SESSION_DRIVER`: `database`
   - `QUEUE_CONNECTION`: `database`

5. Click "Create Web Service"

## Step 3: Update Schema (if needed)

If your application uses any SQLite-specific features that don't work in PostgreSQL, you may need to SSH into your instance to troubleshoot:

```bash
php artisan migrate:status
php artisan migrate:fresh --seed --force
```

## Step 4: Additional Configuration

### Scheduler (Optional)

If you use Laravel's scheduler, add a Background Worker in Render with:
- Build Command: `composer install`
- Start Command: `php artisan schedule:run`

### File Storage

For file uploads, configure environment variables for S3 storage or use Render's disk (temporary storage).