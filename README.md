<div align="center">

# Karigor

![Laravel](https://img.shields.io/badge/Laravel-11.x-red?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue?style=flat-square&logo=php)
![SQLite](https://img.shields.io/badge/SQLite-Database-003B57?style=flat-square&logo=sqlite)
![Vite](https://img.shields.io/badge/Vite-6.x-646CFF?style=flat-square&logo=vite)


This project is an online car workshop appointment system designed to bring efficiency and organization to the service process. It aims to eliminate the hassle of in-person bookings and reduce chaos by allowing customers to schedule appointments online, while also streamlining the assignment of mechanics through a structured digital system.

</div>

## Features

### User Panel (Client Side)
- Clients can book an appointment online without creating an account.
- A mechanic can be assigned to **a maximum of 4 active cars per day**.
- If the desired mechanic is fully booked, they will not appear in the available list.
- Clients can not book multiple appointments for the same day.

### Admin Panel
- Admin can view all booked appointments.
- Admin can:
  - Modify the appointment date
  - Reassign mechanics (only if the target mechanic has less than 4 assignments)


## Prerequisites

Before setting up the project, you need to install the following software on your system:

### 1. Install Git

**Windows:**
- Download Git from [https://git-scm.com/download/win](https://git-scm.com/download/win)
- Run the installer and follow the setup wizard
- Accept default settings for most options

**Linux (Ubuntu/Debian):**
```bash
sudo apt update
sudo apt install git
```

### 2. Install PHP 8.x

**Windows:**
- Download PHP from [https://windows.php.net/download/](https://windows.php.net/download/)
- Choose "Thread Safe" version for your architecture (x64 or x86)
- Extract to `C:\php` (or your preferred location)
- Add PHP to your system PATH:
  - Open System Properties → Advanced → Environment Variables
  - Add `C:\php` to your PATH variable
- Verify installation: Open Command Prompt and run `php -v`

**Linux (Ubuntu/Debian):**
```bash
sudo apt update
sudo apt install php8.3 php8.3-cli php8.3-xml php8.3-sqlite3 php8.3-mbstring php8.3-curl php8.3-zip
```

### 3. Install Composer

**Windows:**
- Download Composer installer from [https://getcomposer.org/download/](https://getcomposer.org/download/)
- Run `Composer-Setup.exe` and follow the installation wizard
- Verify installation: Open Command Prompt and run `composer --version`

**Linux (Ubuntu/Debian):**
```bash
sudo apt update
sudo apt install composer
```

### 4. Verify Installation

After installing all prerequisites, verify your setup:
```bash
git --version
php -v
composer --version
```

## Installation

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

   **For Local Development (SQLite - Recommended for beginners):**
   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=./database/database.sqlite
   ```
   
   **For Production or Advanced Setup (PostgreSQL):**
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=your-postgres-host
   DB_PORT=5432
   DB_DATABASE=your-database-name
   DB_USERNAME=your-username
   DB_PASSWORD=your-password
   ```
   
   **Note:** The live demo uses PostgreSQL, but for local development, SQLite is easier to set up.

5. Run migrations:
   ```bash
   php artisan migrate
   ```

6. Start the local server:
   ```bash
   php artisan serve
   ```

7. Visit [http://localhost:8000](http://localhost:8000)

## Live Demo

You can try the live demo of this website here: [https://karigor.onrender.com/](https://karigor.onrender.com/)

*Note: As this is deployed on a free hosting service, the server may take up to one minute to boot if it has been idle.*

## Roles

- **Clients** can book appointments with available mechanics.
- **Admin** has full control over managing and updating appointments.

## Important Instructions

1. The administrative interface is not visible to regular users on any public-facing pages. The admin login page can be accessed via: [http://localhost:8000/admin/login](http://localhost:8000/admin/login)
2. The default administrator email is `admin@gmail.com` and the default password is `admin123`.
3. Once logged into the admin panel, you have the ability to add mechanics. These added mechanics will then be available for selection when users book appointments.

## Troubleshooting

### Common Issues and Solutions

**1. "Please provide a valid cache path" Error:**
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

**2. Permission Denied Errors (Linux/Mac):**
```bash
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R www-data:www-data storage bootstrap/cache
```

**3. Missing PHP Extensions:**
```bash
# Linux (Ubuntu/Debian)
sudo apt install php8.3-mbstring php8.3-xml php8.3-curl php8.3-zip php8.3-sqlite3
```

**4. Composer Install Fails:**
```bash
composer clear-cache
composer install --no-cache
```

**5. Migration Errors:**
```bash
php artisan migrate:fresh --force
```

**6. Key Not Set Error:**
```bash
php artisan key:generate
```

### Need Help?

If you encounter any issues not covered above, please:
1. Check the Laravel logs in `storage/logs/laravel.log`
2. Ensure all prerequisites are properly installed
3. Verify your `.env` file configuration
4. Try running `php artisan config:cache` after making changes


## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

<div align="center">
  <p>⭐ Star this repo if you found it helpful!</p>
</div>
