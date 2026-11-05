@extends('layout.layout')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-car-front"></i> Form Tambah Kendaraan</h5>
        <a href="{{ route('admin.kendaraan.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.kendaraan.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="plat_nomor" class="form-label">Plat Nomor</label>
                <input type="text" name="plat_nomor" id="plat_nomor" class="form-control @error('plat_nomor') is-invalid @enderror" value="{{ old('plat_nomor') }}" placeholder="Contoh: B 1234 ABC" required>
            </div>

            <div class="mb-3">
                <label for="pemilik" class="form-label">Nama Pemilik / Keterangan</label>
                <input type="text" name="pemilik" id="pemilik" class="form-control @error('pemilik') is-invalid @enderror" value="{{ old('pemilik') }}" placeholder="Contoh: Umum / Budi">
            </div>

            <div class="mb-3">
                <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan</label>
                <select name="jenis_kendaraan" id="jenis_kendaraan" class="form-select @error('jenis_kendaraan') is-invalid @enderror" required>
                    <option value="">-- Pilih Jenis Kendaraan --</option>
                    <option value="mobil" {{ old('jenis_kendaraan') == 'mobil' ? 'selected' : '' }}>Mobil</option>
                    <option value="motor" {{ old('jenis_kendaraan') == 'motor' ? 'selected' : '' }}>Motor</option>
                    <option value="Truk" {{ old('jenis_kendaraan') == 'Truk' ? 'selected' : '' }}>Truk</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan
            </button>
            <a href="{{ route('admin.kendaraan.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection