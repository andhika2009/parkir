<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Kendaraan;
use App\Models\Tarif;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $aktif = Transaksi::with(['kendaraan', 'tarif', 'area'])
            ->whereNull('waktu_keluar')
            ->latest('waktu_masuk')
            ->get();

        $areas  = Area::all();
        $tarifs = Tarif::all();

       return view('petugas.transaksi.index', compact('aktif', 'areas', 'tarifs'));
    }

       public function store(Request $request)
    {
        $data = $request->validate([
            'plat_nomer'      => 'required|string|max:20',
            'jenis_kendaraan' => 'required|string|exists:tb_tarif,jenis_kendaraan',
            'id_area'         => 'required|exists:tb_area_parkir,id_area',
        ]);

        $plat    = strtoupper(trim($data['plat_nomer']));
        $idUser  = auth()->user()->id_user;

        // Kendaraan yang sama tidak boleh masuk dua kali
        $sudahMasuk = Transaksi::whereNull('waktu_keluar')
            ->whereHas('kendaraan', fn ($q) => $q->where('plat_nomer', $plat))
            ->exists();

        if ($sudahMasuk) {
            return back()->withErrors(['plat_nomer' => 'Kendaraan ini masih tercatat di area parkir.'])->withInput();
        }

        $tarif = Tarif::where('jenis_kendaraan', $data['jenis_kendaraan'])->firstOrFail();

        $kendaraan = Kendaraan::firstOrCreate(
            ['plat_nomer' => $plat],
            ['jenis_kendaraan' => $data['jenis_kendaraan'], 'id_user' => $idUser]
        );

        Transaksi::create([
            'id_kendaraan' => $kendaraan->id_kendaraan,
            'id_tarif'     => $tarif->id_tarif,
            'id_area'      => $data['id_area'],
            'id_user'      => $idUser,
            'waktu_masuk'  => now(),
            'status'       => 'masuk',
        ]);

        return redirect('/petugas/transaksi')->with('success', 'Kendaraan masuk dicatat.');
    }

    public function keluar($id)
    {
        $trx = Transaksi::with('tarif')->findOrFail($id);

        if ($trx->waktu_keluar) {
            return redirect('/petugas/transaksi/' . $id . '/struk');
        }

        $keluar = now();
        $jam    = max(1, (int) ceil($trx->waktu_masuk->diffInMinutes($keluar) / 60));

        $trx->update([
            'waktu_keluar' => $keluar,
            'durasi_jam'   => $jam,
            'biaya_total'  => $jam * $trx->tarif->tarif_per_jam,
            'status'       => 'keluar',
        ]);

        return redirect('/petugas/transaksi/' . $id . '/struk');
    }

// TEMPEL FUNGSI STRUK DI SINI
public function struk($id)
{
    $trx = Transaksi::with(['kendaraan', 'tarif', 'area'])
        ->findOrFail($id);

    if (!$trx->waktu_keluar) {
        return redirect('/petugas/transaksi')
            ->with('error', 'Kendaraan belum keluar.');
    }

    $waktuMasuk = \Carbon\Carbon::parse($trx->waktu_masuk);
    $waktuKeluar = \Carbon\Carbon::parse($trx->waktu_keluar);

    $durasiJam = $trx->durasi_jam
        ?? max(1, (int) ceil($waktuMasuk->diffInMinutes($waktuKeluar) / 60));

    return view('petugas.transaksi.struk', compact(
        'trx',
        'waktuMasuk',
        'waktuKeluar',
        'durasiJam'
    ));
}
} 