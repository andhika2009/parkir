<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;

class LogController extends Controller
{
    public function index()
    {
        $logs = LogAktivitas::with('user')->latest()->get();

        return view('admin.log.index', compact('logs'));
    }
}