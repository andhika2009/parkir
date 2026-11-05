<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    public function index()
    {
        $tarifs = Tarif::all();
        return view('admin.tarif.index', compact('tarifs'));
    }

    public function create()
    {
        return view('admin.tarif.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jenis_kendaraan' => 'required|string|max:50',
            'tarif_per_jam'   => 'required|numeric|min:0',
        ]);
        Tarif::create($data);

        return redirect()->route('admin.tarif.index')->with('success', 'Tarif berhasil ditambahkan');
    }

    public function edit(Tarif $tarif)
    {
        return view('admin.tarif.edit', compact('tarif'));
    }

    public function update(Request $request, Tarif $tarif)
    {
        $data = $request->validate([
            'jenis_kendaraan' => 'required|string|max:50',
            'tarif_per_jam'   => 'required|numeric|min:0',
        ]);
        $tarif->update($data);

        return redirect()->route('admin.tarif.index')->with('success', 'Tarif berhasil diperbarui');
    }

    public function destroy(Tarif $tarif)
    {
        $tarif->delete();
        return back()->with('success', 'Tarif berhasil dihapus');
    }
}