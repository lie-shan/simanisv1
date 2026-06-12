# Cara Menjalankan Project Simanis

## Prasyarat

Pastikan sudah menginstal:
- PHP ^8.3
- Composer
- Node.js & npm
- Laragon (atau tools web server lain)

## Langkah-langkah

### 1. Buka Terminal di Folder Project

Masuk ke direktori project:

```bash
cd C:\laragon\www\project_simanis
```

### 2. Jalankan Development Server

Jalankan semua service sekaligus (Laravel server, Vite, queue, log):

```bash
composer run dev
```

Atau jalankan secara terpisah:

```bash
# Laravel development server (http://127.0.0.1:8000)
php artisan serve

# Vite untuk hot reload asset (terminal terpisah)
npm run dev
```

## Akses Aplikasi

- **Laravel App**: http://127.0.0.1:8000
- **Vite HMR**: http://localhost:5173 (otomatis)

## Catatan

- Jika pakai **Laragon**, pastikan project berada di folder `C:\laragon\www\`
- Untuk menghentikan server, tekan `Ctrl + C` di terminal
- Jika ada error, pastikan file `.env` sudah ada (copy dari `.env.example`)
