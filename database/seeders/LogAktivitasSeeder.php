<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LogAktivitas;
use App\Models\User;

class LogAktivitasSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        LogAktivitas::create([
            'user_id'    => $user ? $user->id : null,
            'aktivitas' => 'Melakukan login ke sistem',
            'ip_address' => '127.0.0.1',
        ]);

        LogAktivitas::create([
            'user_id'    => $user ? $user->id : null,
            'aktivitas' => 'Menambahkan data kendaraan baru',
            'ip_address' => '127.0.0.1',
        ]);
    }
}