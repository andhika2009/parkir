<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::all();
        return view('admin.area.index', compact('areas'));
    }

    public function create()
    {
        return view('admin.area.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_area' => 'required|string|max:255',
            'kapasitas' => 'required|numeric',
        ]);

        Area::create([
            'nama_area' => $request->nama_area,
            'kapasitas' => $request->kapasitas,
        ]);

        return redirect()->route('admin.area.index')->with('success', 'Area parkir berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $area = Area::findOrFail($id); // Mengambil data area dari DB
        
        return view('admin.area.edit', compact('area')); // Kirim $area ke view
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_area' => 'required|string|max:255',
            'kapasitas' => 'required|numeric',
        ]);

        $area = Area::findOrFail($id);
        $area->update([
            'nama_area' => $request->nama_area,
            'kapasitas' => $request->kapasitas,
        ]);

        return redirect()->route('admin.area.index')->with('success', 'Area parkir berhasil diperbarui!');
    }
public function destroy($id)
{
    $area = Area::findOrFail($id);

    try {
        $area->delete();
        return redirect()->route('admin.area.index')->with('success', 'Area parkir berhasil dihapus!');
    } catch (\Illuminate\Database\QueryException $e) {
        return redirect()->route('admin.area.index')->with('error', 'Gagal menghapus! Area parkir ini sedang digunakan dalam riwayat transaksi.');
    }
}
}