@extends('layout.layout')

@section('title', 'Dashboard Petugas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1">Dashboard Operasional Petugas</h3>
        <p class="text-muted m-0">Ringkasan transaksi dan pencatatan kendaraan masuk/keluar hari ini.</p>
    </div>
    <div class="d-flex gap-2">
        <span class="btn btn-outline-primary disabled fw-bold">
            <i class="bi bi-calendar-event me-1"></i> {{ \Carbon\Carbon::now()->format('d M Y') }}
        </span>
    </div>
</div>

<!-- Kartu Ringkasan Operasional -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 text-uppercase fw-bold fs-7 mb-2">Kendaraan Masuk Hari Ini</h6>
                        <h2 class="fw-bold mb-0">{{ $totalKendaraanHariIni }} Unit</h2>
                    </div>
                    <i class="bi bi-box-arrow-in-right fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 text-uppercase fw-bold fs-7 mb-2">Area Parkir Tersedia</h6>
                        <h2 class="fw-bold mb-0">{{ $totalArea }} Area</h2>
                    </div>
                    <i class="bi bi-geo-alt fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info text-white shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 text-uppercase fw-bold fs-7 mb-2">Pilihan Jenis Tarif</h6>
                        <h2 class="fw-bold mb-0">{{ $totalTarif }} Jenis</h2>
                    </div>
                    <i class="bi bi-tags fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Kendaraan Masuk Terakhir -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h5 class="m-0 fw-bold"><i class="bi bi-car-front me-2 text-primary"></i>5 Kendaraan Terakhir Masuk</h5>
    </div>
    <div class="card-body p-0">
       <table class="table table-hover align-middle mb-0">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Nomor Plat</th>
            <th>Jenis Kendaraan</th>
            <th>Pemilik</th>
        </tr>
    </thead>
    <tbody>

    
        @forelse($kendaraanTerakhir as $index => $k)
            <tr>
                <td>{{ $index + 1 }}</td>
               <td><span class="badge bg-dark fs-6">{{ !empty($k->no_plat) ? $k->no_plat : (!empty($k->plat_nomor) ? $k->plat_nomor : 'B 1234 ABC') }}</span></td>
                <td>{{ $k->jenis_kendaraan ?? '-' }}</td>
                <td>{{ $k->pemilik ?? 'Umum' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center text-muted py-4">Belum ada transaksi kendaraan masuk hari ini.</td>
            </tr>
        @endforelse
    </tbody>
</table>
    </div>
</div>
@endsection