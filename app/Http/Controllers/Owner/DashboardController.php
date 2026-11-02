<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Kendaraan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTransaksi = Transaksi::count();
        $totalKendaraan = Kendaraan::count();

        return view('owner.dashboard', compact('totalTransaksi', 'totalKendaraan'));
    }
}