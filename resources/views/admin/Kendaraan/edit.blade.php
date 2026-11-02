@extends('layout.layout')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-pencil-square"></i> Edit Data Kendaraan</h5>
        <a href="{{ route('admin.kendaraan.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.kendaraan.update', $kendaraan->id_kendaraan) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="plat_nomor" class="form-label">Plat Nomor</label>
                <input type="text" name="plat_nomor" id="plat_nomor" class="form-control @error('plat_nomor') is-invalid @enderror" value="{{ old('plat_nomor', $kendaraan->plat_nomor) }}" required>
                @error('plat_nomor')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="pemilik" class="form-label">Nama Pemilik / Keterangan</label>
                <input type="text" name="pemilik" id="pemilik" class="form-control" value="{{ old('pemilik', $kendaraan->pemilik) }}">
            </div>

            <div class="mb-3">
                <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan</label>
                <select name="jenis_kendaraan" id="jenis_kendaraan" class="form-select" required>
                    <option value="mobil" {{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan) == 'mobil' ? 'selected' : '' }}>Mobil</option>
                    <option value="motor" {{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan) == 'motor' ? 'selected' : '' }}>Motor</option>
                    <option value="lainnya" {{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection