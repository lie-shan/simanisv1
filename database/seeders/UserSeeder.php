<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin TPA Nurul Iman',
            'email' => 'admin@simanis.test',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Staf TPA Nurul Iman',
            'email' => 'staf@simanis.test',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);
    }
}
