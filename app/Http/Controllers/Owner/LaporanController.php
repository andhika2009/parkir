<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        try {
            $laporans = DB::table('tb_parkir')
                ->leftJoin('tb_kendaraan', 'tb_parkir.id_kendaraan', '=', 'tb_kendaraan.id_kendaraan')
                ->leftJoin('users', 'tb_parkir.id_user', '=', 'users.id')
                ->select('tb_parkir.*', 'tb_kendaraan.plat_nomor', 'users.name as nama_petugas')
                ->get();
        } catch (\Exception $e) {
            try {
                $laporans = DB::table('transaksi')
                    ->leftJoin('tb_kendaraan', 'transaksi.id_kendaraan', '=', 'tb_kendaraan.id_kendaraan')
                    ->leftJoin('users', 'transaksi.id_user', '=', 'users.id')
                    ->select('transaksi.*', 'tb_kendaraan.plat_nomor', 'users.name as nama_petugas')
                    ->get();
            } catch (\Exception $ex) {
                $laporans = collect();
            }
        }

        return view('owner.laporan.index', compact('laporans'));
    }
}