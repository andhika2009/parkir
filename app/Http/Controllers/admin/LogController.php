<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends Controller
{
    public function index()
    {
        $logs = collect([
            (object)[
                'created_at' => now()->subMinutes(5),
                'user' => (object)['name' => 'Admin Utama', 'user_name' => 'admin'],
                'aktivitas' => 'Berhasil login ke sistem',
                'ip_address' => '127.0.0.1'
            ],
            (object)[
                'created_at' => now()->subMinutes(15),
                'user' => (object)['name' => 'Admin Utama', 'user_name' => 'admin'],
                'aktivitas' => 'Menambahkan data area baru (Lantai 1 - Blok A)',
                'ip_address' => '127.0.0.1'
            ],
            (object)[
                'created_at' => now()->subHours(1),
                'user' => (object)['name' => 'Petugas Lapangan', 'user_name' => 'petugas'],
                'aktivitas' => 'Mencatat kendaraan masuk (Plat: B 1234 ABC)',
                'ip_address' => '127.0.0.1'
            ],
            (object)[
                'created_at' => now()->subHours(2),
                'user' => (object)['name' => 'Petugas Lapangan', 'user_name' => 'petugas'],
                'aktivitas' => 'Mencatat kendaraan keluar (Plat: B 5678 DEF)',
                'ip_address' => '127.0.0.1'
            ],
        ]);

        return view('admin.log.index', compact('logs'));
    }
}