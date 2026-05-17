<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name'     => 'Administrator',
                'email'    => 'admin@pinjambarang.id',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
                'no_hp'    => '081234567890',
            ],
            [
                'name'     => 'Petugas Gudang',
                'email'    => 'petugas@pinjambarang.id',
                'password' => Hash::make('petugas123'),
                'role'     => 'petugas',
                'no_hp'    => '082345678901',
            ],
            [
                'name'     => 'Maylinda',
                'email'    => 'maylinda@example.com',
                'password' => Hash::make('password123'),
                'role'     => 'peminjam',
                'no_hp'    => '083456789012',
            ],
            [
                'name'     => 'Safira',
                'email'    => 'safira@example.com',
                'password' => Hash::make('password123'),
                'role'     => 'peminjam',
                'no_hp'    => '084567890123',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(['email' => $user['email']], $user);
        }

        $this->command->info('UserSeeder: ' . count($users) . ' user berhasil dibuat.');
    }
}