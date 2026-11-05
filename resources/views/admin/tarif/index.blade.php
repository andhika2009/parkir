@extends('layout.layout')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <strong>Tarif Kendaraan</strong>
        <a href="{{ route('admin.tarif.create') }}" class="btn btn-primary btn-sm">+ Tambah Tarif</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered align-middle">
            <thead>
                <tr><th>#</th><th>Jenis Kendaraan</th><th>Tarif per Jam</th><th width="160">Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($tarifs as $t)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $t->jenis_kendaraan }}</td>
                    <td>Rp {{ number_format($t->tarif_per_jam, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('admin.tarif.edit', $t->id_tarif) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.tarif.destroy', $t->id_tarif) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus tarif ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center">Belum ada tarif</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection