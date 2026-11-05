<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\AreaParkir; // atau Area, sesuaikan nama model area kamu
use App\Models\Tarif;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data hitungan statistik
        $totalKendaraanHariIni = Transaksi::whereDate('created_at', Carbon::today())->count();
        $totalArea = AreaParkir::count(); 
        $totalTarif = Tarif::count();

     $kendaraanTerakhir = Transaksi::with(['kendaraan.user'])->latest('waktu_masuk')->take(5)->get();

        // 3. Kirimkan semua variabel ke view dashboard
        return view('petugas.dashboard', compact(
            'totalKendaraanHariIni',
            'totalArea',
            'totalTarif',
            'kendaraanTerakhir'
        ));
    }
}