<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Ustadz Deden Suteja', 'jk' => 'L', 'tmp_lahir' => 'Garut', 'tgl_lahir' => '1985-03-15', 'no_hp' => '081234567880', 'kampung' => 'Cipanas', 'desa' => 'Sukakarya', 'kecamatan' => 'Tarogong', 'kabupaten' => 'Garut', 'status' => 'Aktif'],
            ['nama' => 'Ustadzah Euis Kusmiati', 'jk' => 'P', 'tmp_lahir' => 'Garut', 'tgl_lahir' => '1990-07-22', 'no_hp' => '081234567881', 'kampung' => 'Cisitu', 'desa' => 'Cisarua', 'kecamatan' => 'Samarang', 'kabupaten' => 'Garut', 'status' => 'Aktif'],
            ['nama' => 'Ustadz Asep Gunawan', 'jk' => 'L', 'tmp_lahir' => 'Bandung', 'tgl_lahir' => '1988-11-08', 'no_hp' => '081234567882', 'kampung' => 'Rancabango', 'desa' => 'Sukajaya', 'kecamatan' => 'Tarogong', 'kabupaten' => 'Garut', 'status' => 'Aktif'],
            ['nama' => 'Ustadzah Neneng Hasanah', 'jk' => 'P', 'tmp_lahir' => 'Garut', 'tgl_lahir' => '1992-02-14', 'no_hp' => '081234567883', 'kampung' => 'Sukamaju', 'desa' => 'Mekarjaya', 'kecamatan' => 'Cilawu', 'kabupaten' => 'Garut', 'status' => 'Aktif'],
            ['nama' => 'Ustadz Cecep Supriadi', 'jk' => 'L', 'tmp_lahir' => 'Tasik', 'tgl_lahir' => '1983-05-30', 'no_hp' => '081234567884', 'kampung' => 'Cikandang', 'desa' => 'Sukarame', 'kecamatan' => 'Cikajang', 'kabupaten' => 'Garut', 'status' => 'Tidak Aktif'],
        ];

        foreach ($data as $item) {
            do {
                $no_registrasi = str_pad(mt_rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
            } while (Guru::where('no_registrasi', $no_registrasi)->exists());

            $item['no_registrasi'] = $no_registrasi;
            Guru::create($item);
        }
    }
}
