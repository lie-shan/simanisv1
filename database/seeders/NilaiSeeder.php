<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Santri;
use Illuminate\Database\Seeder;

class NilaiSeeder extends Seeder
{
    public function run(): void
    {
        $santri = Santri::where('status', 'Aktif')->get();
        $mapel = MataPelajaran::all();
        $semester = 'Ganjil 2025/2026';

        foreach ($santri as $s) {
            $nilaiMapel = [];
            foreach ($mapel as $m) {
                $nilaiMapel[$m->nama_mapel] = rand(60, 100);
            }
            $rata = round(array_sum($nilaiMapel) / count($nilaiMapel), 2);

            Nilai::create([
                'santri_id' => $s->id,
                'nama_santri' => $s->nama,
                'nis' => $s->no_registrasi,
                'kelas' => $s->kelas,
                'semester' => $semester,
                'tahun_ajaran' => '2025/2026',
                'nilai_mapel' => json_encode($nilaiMapel),
                'rata_rata' => $rata,
                'status' => $rata >= 70 ? 'Lulus' : 'Tidak Lulus',
            ]);
        }
    }
}
