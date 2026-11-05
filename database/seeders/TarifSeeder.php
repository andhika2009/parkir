<?php

namespace Database\Seeders;

use App\Models\Tarif;
use Illuminate\Database\Seeder;

class TarifSeeder extends Seeder
{
    public function run(): void
    {
        Tarif::create(['jenis_kendaraan' => 'Motor', 'tarif_per_jam' => 2000]);
        Tarif::create(['jenis_kendaraan' => 'Mobil', 'tarif_per_jam' => 5000]);
        Tarif::create(['jenis_kendaraan' => 'Lainnya', 'tarif_per_jam' => 3000]);
    }
}