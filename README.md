## Overview

This project is developed for the **CSE391 – Programming for the Internet** course assignment. It addresses the need for a more efficient appointment system in a car workshop that employs five senior mechanics. The goal is to eliminate in-person chaos and streamline the mechanic assignment process using an online booking system.

**Note: This branch is configured for deployment to Render.**

## Features

### User Panel (Client Side)
- Clients can book an appointment online without visiting the workshop.
- Inputs required from client:
  - Name
  - Address
  - Phone Number
  - Car License Number
  - Car Engine Number
  - Preferred Appointment Date
  - Desired Mechanic (from the list of available mechanics)
- A mechanic can be assigned to **a maximum of 4 active cars per day**.
- If the desired mechanic is fully booked, they will not appear in the available list.

### Admin Panel
- Admin can view all booked appointments with the following details:
  - Client Name
  - Phone Number
  - Car License Number
  - Appointment Date
  - Assigned Mechanic
- Admin can:
  - Modify the appointment date
  - Reassign mechanics (only if the target mechanic has less than 4 assignments)

## Tech Stack

- **Backend Framework:** Laravel (PHP)
- **Database:** 
  - Development: SQLite
  - Production: PostgreSQL (Render free tier doesn't support SQLite)
- **Frontend:** HTML, JavaScript, Blade Templates (Laravel)
- **Deployment:** Render

## Getting Started

### Prerequisites
- PHP 8.x
- Composer
- SQLite (for local development)
- PostgreSQL (for production)

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/badhon495/Karigor
   cd Karigor
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Set up the environment file:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure database in `.env`:
   
   For local development with SQLite:
   ```
   DB_CONNECTION=sqlite
   DB_DATABASE=./database/database.sqlite
   ```
   
   For production deployment with PostgreSQL on Render:
   ```
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=karigor
   DB_USERNAME=postgres
   DB_PASSWORD=postgres
   ```

   Or use the DATABASE_URL configuration (for Render):
   ```
   DATABASE_URL=postgres://username:password@host:port/database
   ```

5. Run migrations:
   ```bash
   php artisan migrate
   ```

6. Start the local server:
   ```bash
   php artisan serve
   ```

7. Visit [http://localhost:8000](http://localhost:8000)

## Migrating from SQLite to PostgreSQL

For local development, this project includes utility scripts to help with PostgreSQL setup and migration:

1. **Fix PostgreSQL Authentication**:
   ```bash
   chmod +x fix_postgres_auth.sh
   ./fix_postgres_auth.sh
   ```
   This script helps resolve authentication issues with PostgreSQL by offering three options:
   - Set a new password for the PostgreSQL user
   - Create a .pgpass file for passwordless authentication
   - Configure PostgreSQL to use 'trust' authentication

2. **Migrate from SQLite to PostgreSQL**:
   ```bash
   chmod +x migrate_to_postgres.sh
   ./migrate_to_postgres.sh
   ```
   This script:
   - Installs PostgreSQL if not already installed
   - Creates a database for the project
   - Configures PostgreSQL to accept connections
   - Updates the .env file with PostgreSQL settings
   - Runs migrations to set up the database

3. **Fix Common Issues**:
   ```bash
   chmod +x fix.sh
   ./fix.sh
   ```
   This utility script fixes minor errors that may occur during setup.

After running these scripts, your application will be configured to use PostgreSQL locally, similar to the configuration used in production on Render.

## Roles

- **Clients** can book appointments with available mechanics.
- **Admin** has full control over managing and updating appointments.

## Deployment

This project is configured to deploy on Render using PostgreSQL as the database. The free tier of Render does not support SQLite, which is why PostgreSQL is used for the production environment.

Key deployment configurations:
- Database: PostgreSQL
- Web Service: PHP
- Build Command: `composer install && php artisan migrate --force`
- Start Command: `php artisan serve --host 0.0.0.0 --port $PORT`
