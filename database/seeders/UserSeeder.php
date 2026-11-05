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
            'nama_lengkap' => 'Administrator',
            'username'     => 'admin',
            'password'     => Hash::make('password123'),
            'role'         => 'admin',
        ]);

        // Akun Petugas
        User::create([
            'nama_lengkap' => 'Petugas Parkir',
            'username'     => 'petugas',
            'password'     => Hash::make('password123'),
            'role'         => 'petugas',
        ]);

        // Akun Owner
        User::create([
            'nama_lengkap' => 'Owner Parkir',
            'username'     => 'owner',
            'password'     => Hash::make('password123'),
            'role'         => 'owner',
        ]);
    }
}