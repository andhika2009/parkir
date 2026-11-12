<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::orderBy('id_area')->get();
        return view('admin.area.index', compact('areas'));
    }

    public function create()
    {
        return view('admin.area.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_area' => 'required|string|max:100',
            'kapasitas' => 'required|integer|min:1',
        ]);

        Area::create($data);

        return redirect()->route('admin.area.index')->with('success', 'Area berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $area = Area::findOrFail($id);
        return view('admin.area.edit', compact('area'));
    }

    public function update(Request $request, $id)
    {
        $area = Area::findOrFail($id);

        $data = $request->validate([
            'nama_area' => 'required|string|max:100',
            'kapasitas' => 'required|integer|min:1',
        ]);

        $area->update($data);

        return redirect()->route('admin.area.index')->with('success', 'Area berhasil diupdate!');
    }

    public function destroy($id)
    {
        $area = Area::findOrFail($id);

        if (Transaksi::where('id_area', $id)->exists()) {
            return redirect()->route('admin.area.index')
                ->with('error', 'Area tidak bisa dihapus karena sudah dipakai di transaksi.');
        }

        $area->delete();

        return redirect()->route('admin.area.index')->with('success', 'Area berhasil dihapus!');
    }
}