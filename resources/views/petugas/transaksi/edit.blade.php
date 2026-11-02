@extends('layouts.layout')

@section('content')
<div class="col-md-5">
    <h4 class="mb-3">Ubah Plat Kendaraan</h4>
    <form action="{{ route('petugas.transaksi.update', $kendaraan->id_kendaraan) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nomor Plat</label>
            <input type="text" name="plat_nomer" class="form-control"
                   value="{{ old('plat_nomer', $kendaraan->plat_nomer) }}" required>
            @error('plat_nomer') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('petugas.transaksi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection