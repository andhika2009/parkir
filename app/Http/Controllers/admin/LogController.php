<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index()
    {
        // Mengambil data log aktivitas terbaru beserta relasi user
        $logs = LogAktivitas::with('user')->latest()->get();

        return view('admin.log.index', compact('logs'));
    }
}