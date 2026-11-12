<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
            $laporan = DB::table('tb_transaksi')
            ->leftJoin('tb_tarif', 'tb_transaksi.id_tarif', '=', 'tb_tarif.id_tarif')
            ->leftJoin('tb_kendaraan', 'tb_transaksi.id_kendaraan', '=', 'tb_kendaraan.id_kendaraan')
            ->leftJoin('tb_users', 'tb_transaksi.id_user', '=', 'tb_users.id_user')
            ->select(
                'tb_transaksi.*',
                'tb_tarif.jenis_kendaraan',
                'tb_kendaraan.plat_nomer',
                'tb_users.nama_lengkap as nama_petugas'
            )
            ->orderBy('tb_transaksi.id_transaksi')
            ->get();

        return view('owner.laporan.index', compact('laporan'));
    }
}