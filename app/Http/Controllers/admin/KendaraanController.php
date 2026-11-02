<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kendaraan;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::all();
        return view('admin.kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        return view('admin.kendaraan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'plat_nomor'      => 'required|string',
            'jenis_kendaraan' => 'required|string',
            'pemilik'         => 'nullable|string',
        ]);

        try {
            Kendaraan::create([
                'plat_nomor'      => $request->plat_nomor,
                'jenis_kendaraan' => $request->jenis_kendaraan,
                'pemilik'         => $request->pemilik,
            ]);

            return redirect()->route('admin.kendaraan.index')->with('success', 'Data kendaraan berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('admin.kendaraan.index')->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $kendaraan = Kendaraan::where('id_kendaraan', $id)->firstOrFail();
        return view('admin.kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::where('id_kendaraan', $id)->firstOrFail();

        $request->validate([
            'plat_nomor'      => 'required|string',
            'jenis_kendaraan' => 'required|string',
            'pemilik'         => 'nullable|string',
        ]);

        try {
            $kendaraan->update([
                'plat_nomor'      => $request->plat_nomor,
                'jenis_kendaraan' => $request->jenis_kendaraan,
                'pemilik'         => $request->pemilik,
            ]);

            return redirect()->route('admin.kendaraan.index')->with('success', 'Data kendaraan berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->route('admin.kendaraan.index')->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $kendaraan = Kendaraan::where('id_kendaraan', $id)->firstOrFail();

        try {
            $kendaraan->delete();
            return redirect()->route('admin.kendaraan.index')->with('success', 'Data kendaraan berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('admin.kendaraan.index')->with('error', 'Gagal menghapus! Data kendaraan ini masih terikat dengan riwayat transaksi parkir.');
        }
    }
}