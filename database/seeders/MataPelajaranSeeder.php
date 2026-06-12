<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use Illuminate\Database\Seeder;

class MataPelajaranSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kode_mapel' => 'MP01', 'nama_mapel' => 'Tahsin Al-Quran', 'deskripsi' => 'Perbaikan bacaan Al-Quran sesuai tajwid', 'status' => 'Aktif'],
            ['kode_mapel' => 'MP02', 'nama_mapel' => 'Tahfidz Juz 30', 'deskripsi' => 'Hafalan juz terakhir Al-Quran', 'status' => 'Aktif'],
            ['kode_mapel' => 'MP03', 'nama_mapel' => 'Fiqih Ibadah', 'deskripsi' => 'Pembelajaran fiqih dasar ibadah sehari-hari', 'status' => 'Aktif'],
            ['kode_mapel' => 'MP04', 'nama_mapel' => 'Aqidah Akhlak', 'deskripsi' => 'Pembelajaran akidah dan akhlak Islami', 'status' => 'Aktif'],
            ['kode_mapel' => 'MP05', 'nama_mapel' => 'Sejarah Islam', 'deskripsi' => 'Kisah-kisah Islami dan sejarah peradaban Islam', 'status' => 'Aktif'],
            ['kode_mapel' => 'MP06', 'nama_mapel' => 'Bahasa Arab', 'deskripsi' => 'Pembelajaran dasar bahasa Arab', 'status' => 'Aktif'],
            ['kode_mapel' => 'MP07', 'nama_mapel' => 'Praktek Sholat', 'deskripsi' => 'Praktek tata cara sholat yang benar', 'status' => 'Aktif'],
            ['kode_mapel' => 'MP08', 'nama_mapel' => 'Doa Harian', 'deskripsi' => 'Hafalan doa-doa sehari-hari', 'status' => 'Aktif'],
        ];

        foreach ($data as $item) {
            MataPelajaran::create($item);
        }
    }
}
