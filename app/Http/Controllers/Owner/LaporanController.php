<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        // Mengambil data transaksi tanpa memaksakan nama kolom id_transaksi
        $laporan = DB::table('tb_transaksi')
            ->leftJoin('tb_tarif', 'tb_transaksi.id_tarif', '=', 'tb_tarif.id_tarif')
            ->select('tb_transaksi.*', 'tb_tarif.jenis_kendaraan', 'tb_tarif.tarif_per_jam')
            ->get();

        return view('owner.laporan.index', compact('laporan'));
    }
}