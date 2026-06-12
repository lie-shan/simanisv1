<?php

namespace Database\Seeders;

use App\Models\Santri;
use Illuminate\Database\Seeder;

class SantriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Ahmad Rizki Fadillah', 'kelas' => '2A', 'jk' => 'L', 'tmp_lahir' => 'Garut', 'tgl_lahir' => '2014-01-12', 'ortu' => 'H. Hasanudin', 'ibu' => 'Iis Suryani', 'no_hp' => '081234567890', 'kampung' => 'Cipanas', 'desa' => 'Sukakarya', 'kecamatan' => 'Tarogong', 'kabupaten' => 'Garut', 'status' => 'Aktif'],
            ['nama' => 'Siti Aisyah Nur', 'kelas' => '2A', 'jk' => 'P', 'tmp_lahir' => 'Garut', 'tgl_lahir' => '2014-03-05', 'ortu' => 'Deden Suteja', 'ibu' => 'Euis Kusmiati', 'no_hp' => '081234567891', 'kampung' => 'Cipanas', 'desa' => 'Sukakarya', 'kecamatan' => 'Tarogong', 'kabupaten' => 'Garut', 'status' => 'Aktif'],
            ['nama' => 'Muhammad Fajri', 'kelas' => '2B', 'jk' => 'L', 'tmp_lahir' => 'Bandung', 'tgl_lahir' => '2013-02-20', 'ortu' => 'Asep Gunawan', 'ibu' => 'Neneng Hasanah', 'no_hp' => '081234567892', 'kampung' => 'Cisitu', 'desa' => 'Cisarua', 'kecamatan' => 'Samarang', 'kabupaten' => 'Garut', 'status' => 'Aktif'],
            ['nama' => 'Nurul Hidayah', 'kelas' => '1A', 'jk' => 'P', 'tmp_lahir' => 'Garut', 'tgl_lahir' => '2015-07-08', 'ortu' => 'Ujang Kosasih', 'ibu' => 'Ai Nurjannah', 'no_hp' => '081234567893', 'kampung' => 'Rancabango', 'desa' => 'Sukajaya', 'kecamatan' => 'Tarogong', 'kabupaten' => 'Garut', 'status' => 'Aktif'],
            ['nama' => 'Rafi Ahmad Fauzi', 'kelas' => '3A', 'jk' => 'L', 'tmp_lahir' => 'Tasik', 'tgl_lahir' => '2012-11-15', 'ortu' => 'Cecep Supriadi', 'ibu' => 'Sari Dewi', 'no_hp' => '081234567894', 'kampung' => 'Sukamaju', 'desa' => 'Mekarjaya', 'kecamatan' => 'Cilawu', 'kabupaten' => 'Garut', 'status' => 'Aktif'],
            ['nama' => 'Dewi Sartika', 'kelas' => '1B', 'jk' => 'P', 'tmp_lahir' => 'Garut', 'tgl_lahir' => '2015-04-22', 'ortu' => 'Wawan Hermawan', 'ibu' => 'Rina Marlina', 'no_hp' => '081234567895', 'kampung' => 'Cikandang', 'desa' => 'Sukarame', 'kecamatan' => 'Cikajang', 'kabupaten' => 'Garut', 'status' => 'Aktif'],
            ['nama' => 'Andika Pratama', 'kelas' => '2B', 'jk' => 'L', 'tmp_lahir' => 'Jakarta', 'tgl_lahir' => '2013-09-03', 'ortu' => 'Rudi Hartono', 'ibu' => 'Dian Purnama', 'no_hp' => '081234567896', 'kampung' => 'Cimaragas', 'desa' => 'Mekarsari', 'kecamatan' => 'Cimaragas', 'kabupaten' => 'Garut', 'status' => 'Aktif'],
            ['nama' => 'Salma Aulia', 'kelas' => '3A', 'jk' => 'P', 'tmp_lahir' => 'Garut', 'tgl_lahir' => '2012-06-18', 'ortu' => 'Endang Suryana', 'ibu' => 'Tati Sumiati', 'no_hp' => '081234567897', 'kampung' => 'Leuwigajah', 'desa' => 'Sukamulya', 'kecamatan' => 'Cilawu', 'kabupaten' => 'Garut', 'status' => 'Tidak Aktif'],
        ];

        foreach ($data as $item) {
            do {
                $nis = str_pad(mt_rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
            } while (Santri::where('no_registrasi', $nis)->exists());

            $item['no_registrasi'] = $nis;
            Santri::create($item);
        }
    }
}
