<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    public function run(): void
    {
        Area::create(['nama_area' => 'Blok A', 'kapasitas' => 50]);
        Area::create(['nama_area' => 'Blok B', 'kapasitas' => 50]);
        Area::create(['nama_area' => 'Blok C','kapasitas'=> 50]);
    }
}