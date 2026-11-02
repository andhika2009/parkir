@extends('layout.layout')

@section('title', 'Tambah Area Parkir')

@section('content')
<div class="card shadow-sm col-md-8">
    <div class="card-header bg-white py-3">
        <h5 class="m-0 fw-bold">Form Tambah Area Parkir</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.area.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_area" class="form-label">Nama Area / Blok</label>
                <input type="text" class="form-control" id="nama_area" name="nama_area" placeholder="Contoh: Blok A" required>
            </div>
            <div class="mb-3">
                <label for="kapasitas" class="form-label">Kapasitas Slot</label>
                <input type="number" class="form-control" id="kapasitas" name="kapasitas" placeholder="Contoh: 50" required>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Simpan</button>
                <a href="{{ route('admin.area.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection