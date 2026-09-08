# TanggapiKita

A Laravel web application for reporting disasters/incidents and crowdfunding donations in response to them, built as coursework for "Pemrograman Web" (Web Programming). Users can submit disaster reports, which admins verify, and once verified a report can be linked to a donation campaign that other users contribute to (with Midtrans as the payment gateway). The platform also includes an educational content section and admin-side reporting/PDF export tools.

## Features

**Public / User**
- Registration and login (`AuthController`), with a "forgot password" flow
- Home page showing latest educational articles, verified disaster reports, and active donation campaigns (`HomeController`)
- Disaster report submission, editing, and listing, scoped to the logged-in user (`LaporanController`) — reports include title, description, location, and media, and carry a verification `status`
- Public disaster report browsing (`/bencana`)
- Donation campaigns (`DonasiController`): create a campaign from a verified report, view/edit a campaign, contribute to one, view donation history ("riwayat"), and manage campaigns you created ("kelola")
- Online payment via Midtrans, with success/pending redirect pages, and downloading a donation report
- Educational articles listing and detail view (`Edukasi`)
- User profile management, including updating profile info, photo, and password

**Admin** (behind `auth` + `is_admin` middleware)
- Admin dashboard
- Disaster report moderation: verify or delete submitted reports
- Donation report management, including generating a PDF report per donation campaign (via `barryvdh/laravel-dompdf`)
- User account management (list, create, edit, delete)
- Educational content management (CRUD)
- Company/site information management
- Admin profile management (profile info, photo, password)

## Tech Stack

- PHP 8.2+ / Laravel 12
- Blade templates, Bootstrap-based UI (carousel components in views)
- Tailwind CSS 4 and Vite for asset building
- Eloquent ORM with database migrations (SQLite by default per `.env.example`)
- `midtrans/midtrans-php` for payment processing
- `barryvdh/laravel-dompdf` for PDF report generation
- Custom `is_admin` / `is_user` route middleware for role-based access

## Getting Started

### Prerequisites

- PHP 8.2 or later with Composer
- Node.js and npm (for building front-end assets with Vite)
- A Midtrans account/API keys if you intend to exercise the donation payment flow (`config/midtrans.php`)

### Installation

1. Clone the repository and install dependencies:
   ```bash
   git clone https://github.com/unproduktif/PEMWEB-TANGGAPIKITA.git
   cd PEMWEB-TANGGAPIKITA
   composer install
   npm install
   ```
2. Copy the environment file and generate an application key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
3. The default configuration uses SQLite. Create the database file (if it doesn't already exist):
   ```bash
   touch database/database.sqlite
   ```
   (To use MySQL/another database, update the `DB_*` variables in `.env`. A `tanggapikita.sql` dump is also included in the repository root as a reference schema/seed.)
4. Run the database migrations:
   ```bash
   php artisan migrate
   ```
5. Configure Midtrans credentials in `.env` (`config/midtrans.php`) if you want to test the donation payment flow.
6. Build front-end assets:
   ```bash
   npm run build
   ```

## Usage

Start the local development server:

```bash
php artisan serve
```

Or run the combined dev script (PHP server, queue listener, log tailer, and Vite together):

```bash
composer run dev
```

Visit `http://localhost:8000`, register a user account, and submit a disaster report. Once an admin verifies the report, a donation campaign can be created for it and other users can contribute. Admin features (report verification, user management, educational content, PDF reports) are available under `/admin/...` routes to accounts with admin access.

## Project Structure

```
app/Http/Controllers/
├── Admin/                 # Admin-only controllers (dashboard, users, reports, donations, education)
├── AuthController.php     # Login, register, logout, password reset
├── LaporanController.php  # Disaster report CRUD (user-facing)
├── DonasiController.php   # Donation campaigns and Midtrans payment flow
├── UserController.php     # User profile management
app/Http/Middleware/
├── IsAdmin.php, IsUser.php
resources/views/
├── pages/                 # Public/user-facing pages (laporan, donasi, edukasi, bencana)
├── admin/                 # Admin dashboard views
├── auth/                  # Login/register/forgot-password views
database/migrations/       # Schema for users, admins, laporans, donasis, edukasis, etc.
tanggapikita.sql           # Reference SQL dump of the database schema/data
routes/web.php             # All public, user, and admin routes
```
