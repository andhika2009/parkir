<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tarif;

class TarifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarifs = Tarif::all();
        return view('admin.tarif.index', compact('tarifs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tarif.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_kendaraan' => 'required|string|max:255',
            'tarif_per_jam'   => 'required|numeric',
        ]);

        Tarif::create([
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'tarif_per_jam'   => $request->tarif_per_jam,
        ]);

        return redirect()->route('admin.tarif.index')->with('success', 'Tarif berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tarif = Tarif::findOrFail($id);
        return view('admin.tarif.show', compact('tarif'));
    }

    /**
     * Show the form for editing the specified resource.
     */
 public function edit($id)
{
    $tarif = Tarif::findOrFail($id); // Ambil data tarif dari DB
    
    return view('admin.tarif.edit', compact('tarif')); // Kirim $tarif ke view
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tarif = Tarif::findOrFail($id);

        $request->validate([
            'jenis_kendaraan' => 'required|string|max:255',
            'tarif_per_jam'   => 'required|numeric',
        ]);

        $tarif->update([
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'tarif_per_jam'   => $request->tarif_per_jam,
        ]);

        return redirect()->route('admin.tarif.index')->with('success', 'Tarif berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tarif = Tarif::findOrFail($id);
        $tarif->delete();

        return redirect()->route('admin.tarif.index')->with('success', 'Tarif berhasil dihapus!');
    }
}