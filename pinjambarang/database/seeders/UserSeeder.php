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
            ],

            [
                'name'     => 'Maylinda',
                'email'    => 'maylinda@example.com',
                'password' => Hash::make('password123'),
                'role'     => 'peminjam',
            ],
            [
                'name'     => 'Safira',
                'email'    => 'safira@example.com',
                'password' => Hash::make('password123'),
                'role'     => 'peminjam',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(['email' => $user['email']], $user);
        }

        $this->command->info('UserSeeder: ' . count($users) . ' user berhasil dibuat.');
    }
}