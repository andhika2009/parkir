<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\LogController;
use App\Http\Controllers\Owner\LaporanController;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AreaController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    // Admin Routes
    Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
        Route::get('/admin/dashboard', function () {
            $totalUser = \App\Models\User::count();
            $totalKendaraan = \App\Models\Kendaraan::count();
            $totalArea = \App\Models\Area::count();
            $totalTarif = \App\Models\Tarif::count();
            $logs = \App\Models\LogAktivitas::with('user')->latest()->take(5)->get();

            return view('admin.dashboard', compact('totalUser', 'totalKendaraan', 'totalArea', 'totalTarif', 'logs'));
        })->name('admin.dashboard');

        Route::get('/admin/log', [LogController::class, 'index'])->name('admin.log.index');
        Route::resource('admin/tarif', \App\Http\Controllers\admin\TarifController::class, ['names' => 'admin.tarif']);
        Route::resource('admin/area', \App\Http\Controllers\admin\AreaController::class, ['names' => 'admin.area']);
        Route::resource('admin/kendaraan', \App\Http\Controllers\admin\KendaraanController::class, ['names' => 'admin.kendaraan']);
        Route::resource('admin/user', \App\Http\Controllers\admin\UserController::class, ['names' => 'admin.user']);

        // Route untuk menghapus data area parkir
Route::delete('/admin/area/{id}', [AreaController::class, 'destroy'])->name('area.destroy');
    });
// Petugas Routes
    Route::middleware([RoleMiddleware::class . ':petugas'])->group(function () {
        Route::get('/petugas/dashboard', function () {
         Route::put('/petugas/transaksi/{id}/keluar', [\App\Http\Controllers\Petugas\TransaksiController::class, 'keluar'])->name('petugas.transaksi.keluar');   
            $totalKendaraanHariIni = \App\Models\Kendaraan::count();
            $totalArea = \App\Models\Area::count();
            $totalTarif = \App\Models\Tarif::count();
            $kendaraanTerakhir = \App\Models\Kendaraan::take(5)->get();

            return view('petugas.dashboard', compact('totalKendaraanHariIni', 'totalArea', 'totalTarif', 'kendaraanTerakhir'));
        })->name('petugas.dashboard');

        

        Route::get('/petugas/transaksi', [\App\Http\Controllers\Petugas\TransaksiController::class, 'index'])->name('petugas.transaksi.index');
        Route::post('/petugas/transaksi', [\App\Http\Controllers\Petugas\TransaksiController::class, 'store'])->name('petugas.transaksi.store');
    });
    // Owner Routes
    Route::middleware([RoleMiddleware::class . ':owner'])->group(function () {
    Route::middleware([RoleMiddleware::class . ':owner'])->group(function () {
    Route::get('/owner/laporan', [OwnerController::class, 'laporan'])->name('owner.laporan');
});
        Route::get('/owner/dashboard', [OwnerDashboardController::class, 'index'])->name('owner.dashboard');
       Route::get('/owner/laporan', [LaporanController::class, 'index'])->name('owner.laporan');
    });

});