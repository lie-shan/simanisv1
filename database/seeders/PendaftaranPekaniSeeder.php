<?php

namespace Database\Seeders;

use App\Models\PendaftaranPekani;
use Illuminate\Database\Seeder;

class PendaftaranPekaniSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Hilmi Fadhilah', 'jk' => 'L', 'tmp_lahir' => 'Garut', 'tgl_lahir' => '2014-03-10', 'ortu' => 'Asep Sunarya', 'ibu' => 'Iis Suryani', 'no_hp' => '081234567920', 'kampung' => 'Cipanas', 'desa' => 'Sukakarya', 'kecamatan' => 'Tarogong', 'kabupaten' => 'Garut', 'asal_sekolah' => 'SDN 1 Sukakarya', 'kelas_sekolah' => '4', 'status' => 'Mendaftar'],
            ['nama' => 'Rizky Pratama', 'jk' => 'L', 'tmp_lahir' => 'Garut', 'tgl_lahir' => '2014-07-22', 'ortu' => 'Deden Suteja', 'ibu' => 'Neneng Hasanah', 'no_hp' => '081234567921', 'kampung' => 'Cisitu', 'desa' => 'Cisarua', 'kecamatan' => 'Samarang', 'kabupaten' => 'Garut', 'asal_sekolah' => 'SDN 2 Cisarua', 'kelas_sekolah' => '4', 'status' => 'Diterima'],
            ['nama' => 'Salma Aisyah', 'jk' => 'P', 'tmp_lahir' => 'Bandung', 'tgl_lahir' => '2015-01-15', 'ortu' => 'Rudi Hermawan', 'ibu' => 'Sari Dewi', 'no_hp' => '081234567922', 'kampung' => 'Rancabango', 'desa' => 'Sukajaya', 'kecamatan' => 'Tarogong', 'kabupaten' => 'Garut', 'asal_sekolah' => 'SDIT Al-Fathan', 'kelas_sekolah' => '3', 'status' => 'Diterima'],
        ];

        foreach ($data as $item) {
            do {
                $no = 'PK' . date('Y') . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
            } while (\App\Models\PendaftaranPekani::where('no_pendaftaran', $no)->exists());

            $item['no_pendaftaran'] = $no;
            PendaftaranPekani::create($item);
        }
    }
}
