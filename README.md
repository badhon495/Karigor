## Overview

This project is developed for the **CSE391 – Programming for the Internet** course assignment. It addresses the need for a more efficient appointment system in a car workshop that employs five senior mechanics. The goal is to eliminate in-person chaos and streamline the mechanic assignment process using an online booking system.

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
- **Database:** SQLite
- **Frontend:** HTML, JavaScript, Blade Templates (Laravel)

## Getting Started

### Prerequisites
- PHP 8.x
- Composer
- SQLite

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

4. Configure SQLite in `.env`:
   ```
   DB_CONNECTION=sqlite
   DB_DATABASE=./database/database.sqlite
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


## Roles

- **Clients** can book appointments with available mechanics.
- **Admin** has full control over managing and updating appointments.


## Important Instructions

1.  The administrative interface is not visible to regular users on any public-facing pages. The admin login page can be accessed via the following link: [http://localhost:8000/admin/login](https://www.google.com/search?q=http://localhost:8000/admin/login)
2.  The default administrator email is `admin@gmail.com` and the default password is `admin123`.
3.  Once logged into the admin panel, you have the ability to add mechanics. These added mechanics will then be available for selection when users book appointments.