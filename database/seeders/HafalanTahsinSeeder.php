<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\HafalanTahsin;
use App\Models\Kelas;
use App\Models\Santri;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class HafalanTahsinSeeder extends Seeder
{
    public function run(): void
    {
        $santri = Santri::where('status', 'Aktif')->get();
        $kelas = Kelas::all();
        $guru = Guru::where('status', 'Aktif')->get();

        if ($santri->isEmpty() || $guru->isEmpty()) return;

        $surahList = ['An-Nas', 'Al-Falaq', 'Al-Ikhlas', 'Al-Lahab', 'Al-Kafirun', 'Al-Kautsar', 'Al-Maun', 'Al-Quraisy', 'Al-Fil', 'Al-Ashr', 'At-Takatsur'];
        $statusList = ['Lancar', 'Kurang Lancar', 'Belum Lancar'];

        foreach ($santri as $i => $s) {
            $k = $kelas->where('nama_kelas', $s->kelas)->first();
            HafalanTahsin::create([
                'santri_id' => $s->id,
                'kelas_id' => $k?->id,
                'guru_id' => $guru->random()->id,
                'santri' => $s->nama,
                'kelas' => $s->kelas,
                'jenis' => $i % 2 === 0 ? 'Hafalan' : 'Tahsin',
                'surah' => $surahList[array_rand($surahList)],
                'ayat' => rand(1, 5) . '-' . rand(6, 20),
                'keterangan' => 'Setoran ke-' . rand(1, 10),
                'status' => $statusList[array_rand($statusList)],
                'tanggal' => Carbon::now()->subDays(rand(1, 60))->format('Y-m-d'),
                'pengajar' => $guru->random()->nama,
            ]);
        }
    }
}
