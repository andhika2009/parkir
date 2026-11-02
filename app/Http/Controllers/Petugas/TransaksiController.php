<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        // Ambil data transaksi aktif beserta gabungan jadual tarif (Left Join)
        // Gunakan leftJoin supaya jika tarif kosong/null, data transaksi tetap keluar tanpa Error 500
        $dataTampil = DB::table('tb_transaksi')
            ->leftJoin('tb_tarif', 'tb_transaksi.id_tarif', '=', 'tb_tarif.id_tarif')
            ->select('tb_transaksi.*', 'tb_tarif.jenis_kendaraan')
            ->whereNull('tb_transaksi.waktu_keluar')
            ->get();

        return view('petugas.transaksi.index', compact('dataTampil'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_plat' => 'required',
        ]);

        $plat = strtoupper(trim($request->no_plat));

        // Simpan transaksi baru
        DB::table('tb_transaksi')->insert([
            'no_plat' => $plat,
            'waktu_masuk' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Kendaraan ' . $plat . ' berhasil dicatat masuk!');
    }

    public function update(Request $request, $id)
    {
        // Proses keluar / bayar transaksi
        DB::table('tb_transaksi')
            ->where('id_transaksi', $id)
            ->update([
                'waktu_keluar' => now(),
                'updated_at' => now(),
            ]);

        return redirect()->back()->with('success', 'Transaksi berhasil diproses!');
    }
}