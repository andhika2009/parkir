@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-4">
        <i class="bi bi-p-square-fill text-primary"></i> Operasional Transaksi Parkir
    </h3>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white fw-bold">
            <i class="bi bi-car-front-fill"></i> Data Kendaraan Dalam Area Parkir (Aktif)
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>No Plat</th>
                            <th>Jenis</th>
                            <th width="40%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataTampil as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->no_plat }}</td>
                          <td>
                                <span class="badge bg-info text-dark">
                                    {{ optional($item->tarif)->jenis_kendaraan ?? $item->jenis_kendaraan ?? 'Lainnya' }}
                                </span>
                           </td>
                            <td class="text-center">
                                <form action="{{ url('/petugas/transaksi/' . ($item->id_transaksi ?? $item->id)) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-warning btn-sm text-dark fw-semibold">
                                        Proses Keluar / Bayar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">Belum ada data kendaraan aktif.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection