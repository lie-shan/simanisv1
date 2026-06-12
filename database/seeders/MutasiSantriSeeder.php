<?php

namespace Database\Seeders;

use App\Models\MutasiSantri;
use App\Models\Santri;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MutasiSantriSeeder extends Seeder
{
    public function run(): void
    {
        $santri = Santri::where('status', 'Tidak Aktif')->get();
        if ($santri->isEmpty()) return;

        foreach ($santri as $s) {
            MutasiSantri::create([
                'santri_id' => $s->id,
                'kelas_asal' => $s->kelas,
                'kelas_tujuan' => 'Keluar',
                'tgl_mutasi' => Carbon::now()->subDays(rand(30, 180))->format('Y-m-d'),
                'alasan' => 'Pindah sekolah',
                'keterangan' => 'Mutasi karena pindah domisili',
            ]);
        }
    }
}
