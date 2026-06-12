<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $kelasList = ['1A', '1B', '2A', '2B', '3A', '3B'];
        $walasList = ['Ust. Ahmad Fauzi', 'Ust. Siti Nurhaliza', 'Ust. Budi Santoso', 'Ust. Dewi Lestari', 'Ust. Rudi Hermawan', 'Ust. Ani Rahmawati'];

        foreach ($kelasList as $i => $nama) {
            Kelas::create([
                'nama_kelas' => $nama,
                'wali_kelas' => $walasList[$i] ?? null,
                'deskripsi' => 'Kelas ' . $nama . ' TPA Nurul Iman',
            ]);
        }
    }
}
