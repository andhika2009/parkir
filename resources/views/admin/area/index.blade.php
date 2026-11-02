@extends('layout.layout')

@section('title', 'Data Area Parkir')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="m-0 fw-bold"><i class="bi bi-geo-alt me-2 text-primary"></i>Daftar Area Parkir</h5>
        <a href="{{ route('admin.area.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i>Tambah Area
        </a>
    </div>
    <div class="card-body p-0">
        <!-- Taruh Notifikasi di Baris 14 -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Area / Blok</th>
                    <th>Kapasitas Slot</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($areas as $index => $area)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ $area->nama_area }}</strong></td>
                <td>{{ $area->kapasitas }}</td>
          <td>
                    <!-- Tombol Edit -->
                    <a href="{{ route('admin.area.edit', $area->id_area) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i> Edit
                    </a>

                    <!-- Form & Tombol Hapus -->
                <form action="{{ route('admin.area.destroy', $area->id_area) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus area ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
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