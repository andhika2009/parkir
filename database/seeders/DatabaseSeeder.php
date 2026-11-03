<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
   public function run(): void
{
    \App\Models\User::create([
        'nama_lengkap' => 'Administrator',
        'user_name'    => 'admin',
        'password'     => bcrypt('admin'), // atau Hash::make('admin')
        'role'         => 'admin',
        'status_aktif' => true,
    ]);
    
    \App\Models\User::create([
        'nama_lengkap' => 'Petugas Parkir',
        'user_name'    => 'petugas',
        'password'     => bcrypt('petugas'),
        'role'         => 'petugas',
        'status_aktif' => true,
    ]);
}
}
