@extends('layout.layout')

@section('title', 'Edit Tarif Parkir')

@section('content')
<div class="card shadow-sm col-md-8">
    <div class="card-header bg-white py-3">
        <h5 class="m-0 fw-bold">Form Edit Tarif</h5>
    </div>
    <div class="card-body">
   <form action="{{ route('admin.tarif.update', $tarif) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan</label>
                <input type="text" class="form-control" id="jenis_kendaraan" name="jenis_kendaraan" value="{{ $tarif->jenis_kendaraan }}" required>
            </div>
            <div class="mb-3">
                <label for="tarif_per_jam" class="form-label">Tarif Per Jam (Rp)</label>
                <input type="number" class="form-control" id="tarif_per_jam" name="tarif_per_jam" value="{{ $tarif->tarif_per_jam }}" required>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success"><i class="bi bi-check-circle me-1"></i>Perbarui</button>
                <a href="{{ route('admin.tarif.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection