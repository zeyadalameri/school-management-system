# School Management System (Laravel + Filament)

A portfolio-ready **School Management System** built with **Laravel 9** and **Filament 2**. It provides an admin panel to manage core school operations such as students, classes/sections, attendance, assessments, and fee invoicing.

> The Laravel application lives under the `school-management-system/` subfolder. This repository-level README exists so the project is properly presented on GitHub.

## Features

- Filament-powered admin panel
- Academic years, grades, and classes/sections
- Students & guardians management
- Teachers & subjects management
- Enrollments/registrations
- Attendance tracking
- Assessments, grading, and results
- Fees invoicing & payments
- User management & roles/permissions (Spatie Laravel Permission)

## Tech Stack

- **Backend:** Laravel 9 (PHP ^8.0)
- **Admin UI:** Filament 2
- **Database:** MySQL (XAMPP/MariaDB is fine)
- **Auth/Permissions:** Laravel Sanctum (installed), Spatie Laravel Permission
- **Frontend build:** Laravel Mix + TailwindCSS

## Requirements

- PHP **8.0+**
- Composer
- Node.js + npm
- MySQL

## Repository Structure

```text
.
├── README.md                     # (this file)
└── school-management-system/      # Laravel application
    ├── app/
    ├── bootstrap/
    ├── config/
    ├── database/
    ├── public/
    ├── resources/
    ├── routes/
    ├── storage/
    ├── tests/
    ├── artisan
    ├── composer.json
    └── package.json
```

## Local Setup

All commands below assume you are inside the Laravel app folder:

```bash
cd school-management-system
```

### 1) Install PHP dependencies

```bash
composer install
```

### 2) Configure environment

#### Windows (PowerShell / CMD)

```bash
copy .env.example .env
php artisan key:generate
```

#### Linux / macOS

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and set your local DB credentials.

### 3) Create database

Create a database named `school_management` (or update `.env` accordingly):

```sql
CREATE DATABASE school_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 4) Run migrations and seed demo data

```bash
php artisan migrate --seed
```

### 5) Install & build frontend assets

#### Windows

```bash
npm.cmd install
npm.cmd run prod
```

#### Linux / macOS

```bash
npm install
npm run prod
```

### 6) Run the local server

```bash
php artisan serve --host=127.0.0.1 --port=8000
```

Admin panel:

- `http://127.0.0.1:8000/admin`

## Demo Admin Credentials

> For seeded demo data only.

- Email: `admin@school.test`
- Password: `password`

## Security

- Never commit `.env` (this repository ignores it).
- Use seeded/demo data only when capturing screenshots.
- Avoid exposing any secrets (APP_KEY, DB credentials, SMTP) in terminal output or screenshots.

## Screenshots

Screenshots were **not added in this PR** because this run cannot execute the application locally to capture verified UI screenshots.

When you run the project locally with seeded demo data, add screenshots here:

```text
school-management-system/docs/screenshots/
```

Recommended screens:
- Login
- Dashboard
- Students
- Attendance
- Fees

Then reference them in this README, e.g.:

```md
![Dashboard](school-management-system/docs/screenshots/dashboard.png)
```

## Architecture Overview

```mermaid
graph TD
  U[Admin User (Browser)] -->|HTTP| APP[Laravel 9 App]
  APP -->|Admin UI| FIL[Filament 2 Panel]
  APP -->|RBAC| PERM[Spatie Permission]
  APP --> DB[(MySQL)]
  APP --> FS[Storage (local)]

  subgraph Domain Modules
    Y[Academic Years]
    C[Classes/Sections]
    S[Students/Guardians]
    T[Teachers/Subjects]
    A[Attendance]
    G[Assessments/Grades]
    F[Fees/Payments]
    R[Roles/Users]
  end

  APP --> Y
  APP --> C
  APP --> S
  APP --> T
  APP --> A
  APP --> G
  APP --> F
  APP --> R
```

## Roadmap (Suggested)

- Add CI workflow (PHPUnit) for pull requests
- Add Docker development environment (Laravel Sail)
- Add feature tests for key modules (students, attendance, fees)
- Provide a small script/checklist for capturing and updating screenshots

## Author

- zeyadalameri
