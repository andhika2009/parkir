<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        User::create([
            'username' => 'admin',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
        ]);

        // Akun Petugas
        User::create([
            'username' => 'petugas',
            'password' => Hash::make('password123'),
            'role'     => 'petugas',
        ]);

        // Akun Owner
        User::create([
            'username' => 'owner',
            'password' => Hash::make('password123'),
            'role'     => 'owner',
        ]);
    }
}