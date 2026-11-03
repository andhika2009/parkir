<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'tb_kendaraan';
    protected $primaryKey = 'id_kendaraan';

    public $timestamps = false;

   protected $fillable = [
    'no_plat', // Sesuaikan di sini (bukan plat_nomor)
    'pemilik',
    'jenis_kendaraan',
    'id_tarif'
];
}
