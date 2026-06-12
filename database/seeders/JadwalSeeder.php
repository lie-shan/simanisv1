<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $kelas = Kelas::first();
        $guru = Guru::where('status', 'Aktif')->get();
        $mapel = MataPelajaran::all();

        if (!$kelas || $guru->isEmpty() || $mapel->isEmpty()) return;

        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $jamMulai = ['07:00','07:45','08:30','09:15','10:00','10:45','11:30'];
        $jamSelesai = ['07:45','08:30','09:15','10:00','10:45','11:30','12:15'];

        foreach ($hariList as $hari) {
            foreach ($jamMulai as $idx => $j) {
                $m = $mapel->get(($idx + array_search($hari, $hariList)) % $mapel->count());
                $g = $guru->random();
                Jadwal::create([
                    'kelas_id' => $kelas->id,
                    'guru_id' => $g->id,
                    'mata_pelajaran_id' => $m->id,
                    'hari' => $hari,
                    'jam_ke' => $idx + 1,
                    'jam_mulai' => $j,
                    'jam_selesai' => $jamSelesai[$idx] ?? '12:15',
                ]);
            }
        }
    }
}
