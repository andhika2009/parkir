@extends('layout.layout')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 fw-bold">Dashboard Owner</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Selamat Datang di Panel Rekapitulasi Owner</li>
    </ol>

    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 bg-white">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Transaksi Parkir</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTransaksi ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-receipt fs-1 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2 bg-white">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Kendaraan Terdaftar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKendaraan ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-car-front fs-1 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection