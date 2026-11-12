
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\LogController;
use App\Http\Controllers\Admin\TarifController;
use App\Http\Controllers\Owner\LaporanController;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;
use App\Http\Middleware\RoleMiddleware;

use App\Http\Controllers\Petugas\TransaksiController;
use App\Http\Controllers\admin\AreaController;
use App\Http\Controllers\admin\KendaraanController;
use App\Http\Controllers\admin\UserController;

// LOGIN
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ROUTE SETELAH LOGIN
Route::middleware(['auth'])->group(function () {

    // ================= ADMIN =================
    Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {

        Route::get('/admin/dashboard', function () {
            $totalUser = \App\Models\User::count();
            $totalKendaraan = 0;
            $totalArea = 0;
            $totalTarif = 0;
            $logs = [];

            return view('admin.dashboard', compact(
                'totalUser',
                'totalKendaraan',
                'totalArea',
                'totalTarif',
                'logs'
            ));
        })->name('admin.dashboard');

        Route::get('/admin/log', [LogController::class, 'index'])
            ->name('admin.log.index');

        Route::resource('admin/tarif', TarifController::class, [
            'names' => 'admin.tarif'
        ]);
        

        Route::resource('admin/area', AreaController::class, [
            'names' => 'admin.area'
        ]);

        Route::resource('admin/kendaraan', KendaraanController::class, [
            'names' => 'admin.kendaraan'
        ]);

        Route::resource('admin/user', UserController::class, [
            'names' => 'admin.user'
        ]);
    });

    // ================= PETUGAS =================
    Route::middleware([RoleMiddleware::class . ':petugas'])->group(function () {

        Route::get('/petugas/dashboard', function () {
            $totalKendaraanHariIni = \App\Models\Kendaraan::count();
            $totalArea = \App\Models\Area::count();
            $totalTarif = \App\Models\Tarif::count();

            $kendaraanTerakhir = \App\Models\Kendaraan::take(5)->get();

            return view('petugas.dashboard', compact(
                'totalKendaraanHariIni',
                'totalArea',
                'totalTarif',
                'kendaraanTerakhir'
            ));
        })->name('petugas.dashboard');

        Route::get('/petugas/transaksi', [TransaksiController::class, 'index'])
            ->name('petugas.transaksi.index');

        Route::post('/petugas/transaksi', [TransaksiController::class, 'store'])
            ->name('petugas.transaksi.store');

        Route::put('/petugas/transaksi/{id}/keluar', [TransaksiController::class, 'keluar'])
            ->name('petugas.transaksi.keluar');

            Route::get('/petugas/transaksi/{id}/struk', [TransaksiController::class, 'struk'])
    ->name('petugas.transaksi.struk');
    });

    // ================= OWNER =================
    Route::middleware([RoleMiddleware::class . ':owner'])->group(function () {

        Route::get('/owner/dashboard', [OwnerDashboardController::class, 'index'])
            ->name('owner.dashboard');

        Route::get('/owner/laporan', [LaporanController::class, 'index'])
            ->name('owner.laporan');
    });

});
