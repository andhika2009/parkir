@extends('layout.layout')

@section('title', 'Dashboard Administrator')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white p-3 shadow-sm">
            <small>Total User</small>
            <h3 class="m-0">12 User</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white p-3 shadow-sm">
            <small>Area Terisi</small>
            <h3 class="m-0">45 / 100 Slot</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-dark p-3 shadow-sm">
            <small>Total Kendaraan Hari Ini</small>
            <h3 class="m-0">128 Unit</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white p-3 shadow-sm">
            <small>Tarif Aktif</small>
            <h3 class="m-0">3 Jenis</h3>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white"><strong>Aktivitas Sistem Terakhir</strong></div>
    <div class="card-body">
        <p class="text-muted">Manajemen penuh sistem parkir dapat diakses melalui menu sidebar di sebelah kiri.</p>
    </div>
</div>
@endsection