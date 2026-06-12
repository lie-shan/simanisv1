<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
    $this->call([
        UserSeeder::class,
        KelasSeeder::class,
        SantriSeeder::class,
        GuruSeeder::class,
        SettingsSeeder::class,
        MataPelajaranSeeder::class,
        NilaiSeeder::class,
        HafalanTahsinSeeder::class,
        KuisUjianSeeder::class,
        TugasSeeder::class,
        MutasiSantriSeeder::class,
        PendaftaranSeeder::class,
        PendaftaranPekaniSeeder::class,
        NotifikasiSeeder::class,
    ]);
    }
}
