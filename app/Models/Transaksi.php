<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'tb_transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $guarded = [];

    protected $casts = [
        'waktu_masuk'  => 'datetime',
        'waktu_keluar' => 'datetime',
    ];

    public function kendaraan() { return $this->belongsTo(Kendaraan::class, 'id_kendaraan', 'id_kendaraan'); }
    public function tarif()     { return $this->belongsTo(Tarif::class, 'id_tarif', 'id_tarif'); }
    public function area()      { return $this->belongsTo(Area::class, 'id_area', 'id_area'); }
}