<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KendaraanController extends Controller
{
    private function getInitialKendaraans()
    {
        return [
            ['id_kendaraan' => 1, 'plat_nomor' => 'B 1234 ABC', 'jenis_kendaraan' => 'Mobil', 'pemilik' => 'Andi'],
            ['id_kendaraan' => 2, 'plat_nomor' => 'B 5678 DEF', 'jenis_kendaraan' => 'Motor', 'pemilik' => 'Budi'],
        ];
    }

    public function index()
    {
        if (!session()->has('dummy_kendaraans')) {
            session(['dummy_kendaraans' => $this->getInitialKendaraans()]);
        }

        $kendaraansData = session('dummy_kendaraans');
        $kendaraans = collect(array_map(fn($item) => (object)$item, $kendaraansData));

        return view('admin.kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        return view('admin.kendaraan.create');
    }

    public function store(Request $request)
    {
        $kendaraans = session('dummy_kendaraans', $this->getInitialKendaraans());

        $maxId = 0;
        foreach ($kendaraans as $k) {
            if ($k['id_kendaraan'] > $maxId) {
                $maxId = $k['id_kendaraan'];
            }
        }

        $newItem = [
            'id_kendaraan' => $maxId + 1,
            'plat_nomor' => $request->plat_nomor ?? 'B 9999 NEW',
            'jenis_kendaraan' => $request->jenis_kendaraan ?? 'Mobil',
            'pemilik' => $request->pemilik ?? 'Pengunjung',
        ];

        $kendaraans[] = $newItem;
        session(['dummy_kendaraans' => $kendaraans]);

        return redirect()->route('admin.kendaraan.index')->with('success', 'Kendaraan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kendaraans = session('dummy_kendaraans', $this->getInitialKendaraans());
        $found = null;

        foreach ($kendaraans as $k) {
            if ($k['id_kendaraan'] == $id) {
                $found = $k;
                break;
            }
        }

        $kData = $found ?? ['id_kendaraan' => $id, 'plat_nomor' => 'B 1234 ABC', 'jenis_kendaraan' => 'Mobil', 'pemilik' => 'Andi'];
        $kendaraan = (object) array_merge($kData, ['id' => $kData['id_kendaraan']]);

        return view('admin.kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, $id)
    {
        $kendaraans = session('dummy_kendaraans', $this->getInitialKendaraans());

        foreach ($kendaraans as &$k) {
            if ($k['id_kendaraan'] == $id) {
                $k['plat_nomor'] = $request->plat_nomor ?? $k['plat_nomor'];
                $k['jenis_kendaraan'] = $request->jenis_kendaraan ?? $k['jenis_kendaraan'];
                $k['pemilik'] = $request->pemilik ?? $k['pemilik'];
            }
        }

        session(['dummy_kendaraans' => $kendaraans]);

        return redirect()->route('admin.kendaraan.index')->with('success', 'Data kendaraan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $kendaraans = session('dummy_kendaraans', $this->getInitialKendaraans());

        $newKendaraans = array_values(array_filter($kendaraans, function ($item) use ($id) {
            return $item['id_kendaraan'] != $id;
        }));

        session(['dummy_kendaraans' => $newKendaraans]);

        return redirect()->route('admin.kendaraan.index')->with('success', 'Data kendaraan berhasil dihapus!');
    }
}