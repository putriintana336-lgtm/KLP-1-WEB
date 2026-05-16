<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'password' => 'admin',
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Mahasiswa Satu',
            'username' => 'mahasiswa',
            'password' => 'mahasiswa',
            'role' => 'user'
        ]);
    }
}