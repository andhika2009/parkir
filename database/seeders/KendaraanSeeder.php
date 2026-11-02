<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kendaraan;
use App\Models\Tarif;

class KendaraanSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID tarif pertama (misal Motor / Mobil)
        $tarif = Tarif::first();

        if ($tarif) {
            Kendaraan::create([
                'plat_nomor' => 'B 1234 CDX',
                'pemilik'    => 'Member / Karyawan',
                'tarif_id'   => $tarif->id,
            ]);

            Kendaraan::create([
                'plat_nomor' => 'D 5678 EFG',
                'pemilik'    => 'Ahmad Dani',
                'tarif_id'   => $tarif->id,
            ]);
        }
    }
}