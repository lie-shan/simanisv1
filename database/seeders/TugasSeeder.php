<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Tugas;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TugasSeeder extends Seeder
{
    public function run(): void
    {
        $kelas = Kelas::all();
        $mapel = MataPelajaran::all();

        if ($kelas->isEmpty() || $mapel->isEmpty()) return;

        $judulList = ['Mengerjakan Soal', 'Menulis Surah', 'Hafalan', 'Membuat Ringkasan', 'Praktik', 'Latihan Soal'];
        $deskripsiList = ['Kerjakan dengan teliti.', 'Tulis rapi dan kumpulkan.', 'Hafalkan sesuai target.', 'Buat ringkasan sederhana.', 'Praktikkan di rumah.'];

        for ($i = 1; $i <= 10; $i++) {
            $k = $kelas->random();
            $m = $mapel->random();
            $aktif = $i <= 6;
            Tugas::create([
                'judul' => $judulList[array_rand($judulList)] . ' ' . $m->nama_mapel,
                'deskripsi' => $deskripsiList[array_rand($deskripsiList)],
                'kelas_id' => $k->id,
                'mata_pelajaran_id' => $m->id,
                'kelas' => $k->nama_kelas,
                'mapel' => $m->nama_mapel,
                'tanggal_dibuat' => Carbon::now()->subDays(rand(1, 10))->format('Y-m-d'),
                'tanggal_deadline' => $aktif
                    ? Carbon::now()->addDays(rand(1, 14))->format('Y-m-d')
                    : Carbon::now()->subDays(rand(1, 15))->format('Y-m-d'),
                'status' => $aktif ? 'Aktif' : 'Selesai',
            ]);
        }
    }
}
