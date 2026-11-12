@extends('layout.layout')
@section('title', 'Dashboard Petugas')

@section('content')
@php
    $totalHariIni = \App\Models\Transaksi::whereDate('waktu_masuk', today())->count();
    $totalAktif   = \App\Models\Transaksi::whereNull('waktu_keluar')->count();
    $totalArea    = \App\Models\Area::count();
    $totalTarif   = \App\Models\Tarif::count();
    $terakhir     = \App\Models\Transaksi::with(['kendaraan', 'tarif', 'area'])
                        ->latest('waktu_masuk')->take(5)->get();
@endphp

<h4 class="fw-bold mb-4">Dashboard Petugas</h4>

<div class="row g-3 mb-4">
    <div class="col-12 col-md-6 col-xl-3">
        <div class="card text-white bg-primary border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="small text-uppercase fw-semibold opacity-75">Masuk Hari Ini</div>
                    <div class="fs-2 fw-bold">{{ $totalHariIni }} <span class="fs-6 fw-normal">Unit</span></div>
                </div>
                <i class="bi bi-box-arrow-in-right fs-1 opacity-50"></i>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="card text-white bg-warning border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="small text-uppercase fw-semibold opacity-75">Sedang Parkir</div>
                    <div class="fs-2 fw-bold">{{ $totalAktif }} <span class="fs-6 fw-normal">Unit</span></div>
                </div>
                <i class="bi bi-car-front fs-1 opacity-50"></i>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="card text-white bg-success border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="small text-uppercase fw-semibold opacity-75">Area Parkir</div>
                    <div class="fs-2 fw-bold">{{ $totalArea }} <span class="fs-6 fw-normal">Area</span></div>
                </div>
                <i class="bi bi-geo-alt fs-1 opacity-50"></i>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="card text-white bg-info border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="small text-uppercase fw-semibold opacity-75">Jenis Tarif</div>
                    <div class="fs-2 fw-bold">{{ $totalTarif }} <span class="fs-6 fw-normal">Jenis</span></div>
                </div>
                <i class="bi bi-tags fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h6 class="m-0 fw-bold"><i class="bi bi-car-front text-primary me-2"></i>5 Kendaraan Terakhir Masuk</h6>
        <a href="{{ url('/petugas/transaksi') }}" class="btn btn-primary btn-sm">Buka Transaksi Parkir</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nomor Plat</th>
                        <th>Jenis</th>
                        <th>Area</th>
                        <th>Waktu Masuk</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($terakhir as $t)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><span class="badge bg-dark fs-6">{{ $t->kendaraan->plat_nomer ?? '-' }}</span></td>
                        <td>{{ $t->kendaraan->jenis_kendaraan ?? '-' }}</td>
                        <td>{{ $t->area->nama_area ?? '-' }}</td>
                        <td>{{ optional($t->waktu_masuk)->format('d M Y H:i') }}</td>
                        <td>
                            @if($t->waktu_keluar)
                                <span class="badge bg-secondary">Keluar</span>
                            @else
                                <span class="badge bg-success">Parkir</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Belum ada kendaraan masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection