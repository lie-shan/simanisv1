# Simanis — TPA Nurul Iman

Sistem Informasi Manajemen Santri TPA Nurul Iman.

## Persyaratan

- PHP ^8.3
- Composer
- Node.js & npm
- MySQL / MariaDB
- Laragon (recommended) atau web server lainnya

## Instalasi

```bash
# Clone repository
git clone https://github.com/lie-shan/simanisv1.git
cd simanisv1

# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install

# Buat file .env (copy dari .env.example)
copy .env.example .env

# Generate app key
php artisan key:generate

# Buat database 'simanis' di MySQL/phpMyAdmin

# Jalankan migrasi dan seeder
php artisan migrate --seed

# Buat storage link
php artisan storage:link
```

## Menjalankan Aplikasi

```bash
# Laravel development server
php artisan serve

# Vite (terminal terpisah, untuk hot reload asset)
npm run dev
```

Akses: http://127.0.0.1:8000

## Login Default (seeder)

- **Email:** admin@simanis.test
- **Password:** password

## Struktur

| Path | Deskripsi |
|------|-----------|
| `app/Http/Controllers/Admin/` | Controller halaman admin |
| `resources/views/admin/` | View halaman admin |
| `resources/views/auth/` | View halaman login/register |
| `resources/views/layouts/` | Layout admin & public |
| `routes/web.php` | Routing aplikasi |
