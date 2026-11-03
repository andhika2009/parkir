@extends('layout.layout')

@section('title', 'Edit Area Parkir')

@section('content')
<div class="card shadow-sm col-md-8">
    <div class="card-header bg-white py-3">
        <h5 class="m-0 fw-bold">Form Edit Area Parkir</h5>
    </div>
    <div class="card-body">
       <form action="{{ route('admin.area.update', $area->id_area) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama_area" class="form-label">Nama Area / Blok</label>
                <input type="text" class="form-control" id="nama_area" name="nama_area" value="{{ $area->nama_area }}" required>
            </div>
            <div class="mb-3">
                <label for="kapasitas" class="form-label">Kapasitas Slot</label>
                <input type="number" class="form-control" id="kapasitas" name="kapasitas" value="{{ $area->kapasitas }}" required>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success"><i class="bi bi-check-circle me-1"></i>Perbarui</button>
                <a href="{{ route('admin.area.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection