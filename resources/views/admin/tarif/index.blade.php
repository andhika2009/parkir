@extends('layout.layout')

@section('title', 'Data Tarif Parkir')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="m-0 fw-bold"><i class="bi bi-tags me-2 text-primary"></i>Daftar Tarif Parkir</h5>
        <a href="{{ route('admin.tarif.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i>Tambah Tarif Baru
        </a>
    </div>
    <div class="card-body p-0">
        @if(session('success'))
            <div class="alert alert-success m-3">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th width="5%">No</th>
                    <th>Jenis Kendaraan</th>
                    <th>Tarif Per Jam</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($tarifs as $index => $tarif)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td><strong>{{ $tarif->jenis_kendaraan }}</strong></td>
            <td>Rp {{ number_format($tarif->tarif_per_jam, 0, ',', '.') }}</td>
            <td>
                <a href="{{ route('admin.tarif.edit', $tarif->id_tarif) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <form action="{{ route('admin.tarif.destroy', $tarif->id_tarif) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus tarif ini?')">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>
            </td>
        </tr>
@endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection