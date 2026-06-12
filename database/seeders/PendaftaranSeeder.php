<?php

namespace Database\Seeders;

use App\Models\Pendaftaran;
use Illuminate\Database\Seeder;

class PendaftaranSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Muhammad Alif', 'jk' => 'L', 'tmp_lahir' => 'Garut', 'tgl_lahir' => '2016-01-10', 'ortu' => 'Ahmad Suryana', 'ibu' => 'Siti Aminah', 'no_hp' => '081234567910', 'kampung' => 'Cipanas', 'desa' => 'Sukakarya', 'kecamatan' => 'Tarogong', 'kabupaten' => 'Garut', 'status' => 'Mendaftar'],
            ['nama' => 'Naila Syifa', 'jk' => 'P', 'tmp_lahir' => 'Garut', 'tgl_lahir' => '2016-04-15', 'ortu' => 'Dede Kurniawan', 'ibu' => 'Rina Marlina', 'no_hp' => '081234567911', 'kampung' => 'Cisitu', 'desa' => 'Cisarua', 'kecamatan' => 'Samarang', 'kabupaten' => 'Garut', 'status' => 'Diterima'],
            ['nama' => 'Rafi Ahmad', 'jk' => 'L', 'tmp_lahir' => 'Bandung', 'tgl_lahir' => '2015-07-20', 'ortu' => 'Cecep Gunawan', 'ibu' => 'Dian Purnama', 'no_hp' => '081234567912', 'kampung' => 'Rancabango', 'desa' => 'Sukajaya', 'kecamatan' => 'Tarogong', 'kabupaten' => 'Garut', 'status' => 'Diterima'],
            ['nama' => 'Zahra Aulia', 'jk' => 'P', 'tmp_lahir' => 'Garut', 'tgl_lahir' => '2016-09-05', 'ortu' => 'Ujang Kosasih', 'ibu' => 'Ai Nurjannah', 'no_hp' => '081234567913', 'kampung' => 'Sukamaju', 'desa' => 'Mekarjaya', 'kecamatan' => 'Cilawu', 'kabupaten' => 'Garut', 'status' => 'Mendaftar'],
            ['nama' => 'Ilham Pratama', 'jk' => 'L', 'tmp_lahir' => 'Tasik', 'tgl_lahir' => '2015-12-18', 'ortu' => 'Hasan Basri', 'ibu' => 'Euis Kusmiati', 'no_hp' => '081234567914', 'kampung' => 'Cikandang', 'desa' => 'Sukarame', 'kecamatan' => 'Cikajang', 'kabupaten' => 'Garut', 'status' => 'Ditolak'],
        ];

        foreach ($data as $item) {
            do {
                $no = 'P' . date('Y') . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
            } while (\App\Models\Pendaftaran::where('no_pendaftaran', $no)->exists());

            $item['no_pendaftaran'] = $no;
            Pendaftaran::create($item);
        }
    }
}
