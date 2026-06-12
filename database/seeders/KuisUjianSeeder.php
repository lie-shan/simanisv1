<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\KuisUjian;
use App\Models\MataPelajaran;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class KuisUjianSeeder extends Seeder
{
    public function run(): void
    {
        $kelas = Kelas::all();
        $mapel = MataPelajaran::all();

        if ($kelas->isEmpty() || $mapel->isEmpty()) return;

        $judulList = ['Kuis Harian', 'UTS', 'Kuis Mingguan', 'UAS', 'Kuis Dadakan', 'Review Materi'];

        for ($i = 1; $i <= 10; $i++) {
            $k = $kelas->random();
            $m = $mapel->random();
            $jenis = $i <= 6 ? 'Kuis' : 'Ujian';
            KuisUjian::create([
                'judul' => $judulList[array_rand($judulList)] . ' ' . $m->nama_mapel,
                'jenis' => $jenis,
                'kelas_id' => $k->id,
                'mata_pelajaran_id' => $m->id,
                'kelas' => $k->nama_kelas,
                'mapel' => $m->nama_mapel,
                'tanggal' => Carbon::now()->subDays(rand(1, 30))->format('Y-m-d'),
                'durasi' => $jenis === 'Ujian' ? rand(60, 90) : rand(10, 25),
                'keterangan' => 'Materi sesuai modul',
                'status' => collect(['Akan Datang', 'Sedang Berlangsung', 'Selesai'])->random(),
            ]);
        }
    }
}
