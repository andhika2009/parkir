<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AreaController extends Controller
{
    private function getInitialAreas()
    {
        return [
            ['id_area' => 1, 'nama_area' => 'Lantai 1 - Blok A', 'kapasitas' => 50],
            ['id_area' => 2, 'nama_area' => 'Lantai 1 - Blok B', 'kapasitas' => 30],
            ['id_area' => 3, 'nama_area' => 'Lantai 2 - VIP', 'kapasitas' => 15],
        ];
    }

    public function index()
    {
        if (!session()->has('dummy_areas')) {
            session(['dummy_areas' => $this->getInitialAreas()]);
        }

        $areasData = session('dummy_areas');
        $areas = collect(array_map(fn($item) => (object)$item, $areasData));

        return view('admin.area.index', compact('areas'));
    }

    public function create()
    {
        return view('admin.area.create');
    }

    public function store(Request $request)
    {
        $areas = session('dummy_areas', $this->getInitialAreas());

        $maxId = 0;
        foreach ($areas as $a) {
            if ($a['id_area'] > $maxId) {
                $maxId = $a['id_area'];
            }
        }

        $newItem = [
            'id_area' => $maxId + 1,
            'nama_area' => $request->nama_area ?? 'Area Baru',
            'kapasitas' => $request->kapasitas ?? 20,
        ];

        $areas[] = $newItem;
        session(['dummy_areas' => $areas]);

        return redirect()->route('admin.area.index')->with('success', 'Area berhasil ditambahkan!');
    }

  public function edit($id)
    {
        $areas = session('dummy_areas', $this->getInitialAreas());
        $found = null;
        
        foreach ($areas as $a) {
            if ($a['id_area'] == $id) {
                $found = $a;
                break;
            }
        }

        $areaData = $found ?? ['id_area' => $id, 'nama_area' => 'Lantai 1 - Blok A', 'kapasitas' => 50];
        
        // Obje yapısını oluştururken id_area ve id değerlerini sayısal (string/int) olarak kesinleştiriyoruz
        $area = (object) $areaData;

        return view('admin.area.edit', compact('area'));
    }

    public function update(Request $request, $id)
    {
        $areas = session('dummy_areas', $this->getInitialAreas());

        foreach ($areas as &$a) {
            if ($a['id_area'] == $id) {
                $a['nama_area'] = $request->nama_area ?? $a['nama_area'];
                $a['kapasitas'] = $request->kapasitas ?? $a['kapasitas'];
            }
        }

        session(['dummy_areas' => $areas]);

        return redirect()->route('admin.area.index')->with('success', 'Area berhasil diupdate!');
    }

    public function destroy($id)
    {
        $areas = session('dummy_areas', $this->getInitialAreas());

        $newAreas = array_values(array_filter($areas, function ($item) use ($id) {
            return $item['id_area'] != $id;
        }));

        session(['dummy_areas' => $newAreas]);

        return redirect()->route('admin.area.index')->with('success', 'Area berhasil dihapus!');
    }
}