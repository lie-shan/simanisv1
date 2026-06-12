<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'app_name', 'group' => 'general', 'type' => 'text', 'label' => 'Nama Aplikasi', 'value' => 'Sistem Informasi Akademik TPA Nurul Iman'],
            ['key' => 'app_description', 'group' => 'general', 'type' => 'textarea', 'label' => 'Deskripsi Aplikasi', 'value' => 'Sistem informasi manajemen pendidikan dan administrasi Taman Pendidikan Al-Qur\'an (TPA) Nurul Iman'],
            ['key' => 'app_logo', 'group' => 'general', 'type' => 'image', 'label' => 'Logo Aplikasi', 'value' => null],
            ['key' => 'app_favicon', 'group' => 'general', 'type' => 'image', 'label' => 'Favicon', 'value' => null],
            ['key' => 'app_short_name', 'group' => 'general', 'type' => 'text', 'label' => 'Nama Singkat', 'value' => 'SIMANIS'],
            ['key' => 'maintenance_mode', 'group' => 'general', 'type' => 'boolean', 'label' => 'Mode Maintenance', 'value' => '0', 'description' => 'Aktifkan untuk menampilkan halaman maintenance ke pengguna'],

            // Contact
            ['key' => 'contact_address', 'group' => 'contact', 'type' => 'textarea', 'label' => 'Alamat', 'value' => 'Jl. Contoh No. 123, Kelurahan, Kecamatan, Kota'],
            ['key' => 'contact_phone', 'group' => 'contact', 'type' => 'text', 'label' => 'No. Telepon', 'value' => '08xxxxxxxxxx'],
            ['key' => 'contact_email', 'group' => 'contact', 'type' => 'email', 'label' => 'Email', 'value' => 'info@tpanuruliman.sch.id'],
            ['key' => 'contact_website', 'group' => 'contact', 'type' => 'text', 'label' => 'Website', 'value' => 'https://tpanuruliman.sch.id'],

            // Academic
            ['key' => 'academic_year', 'group' => 'academic', 'type' => 'text', 'label' => 'Tahun Ajaran Aktif', 'value' => '2025/2026'],
            ['key' => 'academic_semester', 'group' => 'academic', 'type' => 'select', 'label' => 'Semester Aktif', 'value' => 'Genap'],
            ['key' => 'academic_kkm', 'group' => 'academic', 'type' => 'number', 'label' => 'KKM (Kriteria Ketuntasan Minimal)', 'value' => '70'],

            // Payment
            ['key' => 'payment_spp', 'group' => 'payment', 'type' => 'number', 'label' => 'SPP per Bulan', 'value' => '50000'],
            ['key' => 'payment_daftar', 'group' => 'payment', 'type' => 'number', 'label' => 'Biaya Pendaftaran', 'value' => '100000'],
            ['key' => 'payment_kegiatan', 'group' => 'payment', 'type' => 'number', 'label' => 'Biaya Kegiatan', 'value' => '75000'],
            ['key' => 'payment_va_prefix', 'group' => 'payment', 'type' => 'text', 'label' => 'Prefix Virtual Account', 'value' => '99999'],
        ];

        foreach ($settings as $s) {
            Setting::firstOrCreate(
                ['key' => $s['key']],
                $s
            );
        }
    }
}
