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
        User::create([
            'nama_lengkap' => 'Administrator',
            'user_name'    => 'admin',
            'password'     => bcrypt('admin'),
            'role'         => 'admin',
            'status_aktif' => true,
        ]);

        User::create([
            'nama_lengkap' => 'Petugas Parkir',
            'user_name'    => 'petugas',
            'password'     => bcrypt('petugas'),
            'role'         => 'petugas',
            'status_aktif' => true,
        ]);

        User::create([
            'nama_lengkap' => 'Owner',
            'user_name'    => 'owner',
            'password'     => bcrypt('owner'),
            'role'         => 'owner',
            'status_aktif' => true,
        ]);

        $this->call([
            TarifSeeder::class,
            AreaSeeder::class,
        ]);
    }
}