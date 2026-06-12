<?php

namespace Database\Seeders;

use App\Models\Notifikasi;
use Illuminate\Database\Seeder;

class NotifikasiSeeder extends Seeder
{
    public function run(): void
    {
        $notif = [
            [
                'judul' => 'Santri Baru Terdaftar',
                'pesan' => 'Ananda Ahmad Rizki telah terdaftar sebagai santri baru di kelas 1A.',
                'icon' => 'fa-solid fa-user-graduate',
                'warna' => '#0d6efd',
            ],
            [
                'judul' => 'Pembayaran Masuk',
                'pesan' => 'Pembayaran SPP dari Ananda Siti Aisyah sebesar Rp 150.000 telah diterima.',
                'icon' => 'fa-solid fa-money-bill-wave',
                'warna' => '#059669',
            ],
            [
                'judul' => 'Hafalan Baru',
                'pesan' => 'Ananda Muhammad Fikri menyetorkan hafalan baru Surah Al-Fatihah ayat 1-7.',
                'icon' => 'fa-solid fa-book-open',
                'warna' => '#8c62c9',
            ],
            [
                'judul' => 'Absensi Hari Ini',
                'pesan' => 'Total 42 santri hadir, 3 santri izin, 1 santri sakit hari ini.',
                'icon' => 'fa-solid fa-clipboard-check',
                'warna' => '#e66560',
            ],
            [
                'judul' => 'Jadwal Berubah',
                'pesan' => 'Jadwal kelas 2A hari Rabu mengalami perubahan jam pelajaran.',
                'icon' => 'fa-regular fa-calendar-days',
                'warna' => '#d97706',
            ],
        ];

        foreach ($notif as $n) {
            Notifikasi::create($n);
        }
    }
}
