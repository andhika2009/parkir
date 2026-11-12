<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public static function catat(string $aktivitas, $userId = null): void
    {
        static::create([
            'user_id'    => $userId ?? auth()->id(),
            'aktivitas'  => $aktivitas,
            'ip_address' => request()->ip(),
        ]);
    }
}