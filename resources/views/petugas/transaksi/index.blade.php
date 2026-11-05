@extends('layout.layout')

@section('title', 'Transaksi Parkir')

@section('content')
<h3 class="fw-bold mb-4">Operasional Transaksi Parkir</h3>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm mb-4">
    <div class="card-header bg-dark text-white fw-bold">Kendaraan Masuk</div>
    <div class="card-body">
        <form method="POST" action="/petugas/transaksi" class="row g-3">
            @csrf
            <div class="col-md-4">
                <label class="form-label">No Plat</label>
                <input type="text" name="plat_nomer" value="{{ old('plat_nomer') }}" class="form-control @error('plat_nomer') is-invalid @enderror" required>
                @error('plat_nomer') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-3">
                <label class="form-label">Jenis</label>
                <select name="jenis_kendaraan" class="form-select" required>
                    @foreach($tarifs as $t)
                        <option value="{{ $t->jenis_kendaraan }}">{{ $t->jenis_kendaraan }} (Rp {{ number_format($t->tarif_per_jam, 0, ',', '.') }}/jam)</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Area</label>
                <select name="id_area" class="form-select" required>
                    @foreach($areas as $a)
                        <option value="{{ $a->id_area }}">{{ $a->nama_area }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-primary w-100">Simpan Masuk</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-dark text-white fw-bold">Data Kendaraan Dalam Area Parkir (Aktif)</div>
    <table class="table mb-0">
        <thead>
            <tr><th>No</th><th>No Plat</th><th>Jenis</th><th>Area</th><th>Masuk</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @forelse($aktif as $i => $t)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $t->kendaraan->plat_nomer ?? '-' }}</td>
                    <td>{{ $t->kendaraan->jenis_kendaraan ?? '-' }}</td>
                    <td>{{ $t->area->nama_area ?? '-' }}</td>
                    <td>{{ $t->waktu_masuk->format('d/m/Y H:i') }}</td>
                    <td>
                        <form method="POST" action="/petugas/transaksi/{{ $t->id_transaksi }}/keluar" onsubmit="return confirm('Proses kendaraan keluar?')">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-sm btn-danger">Keluar &amp; Cetak Struk</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada data kendaraan aktif.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection