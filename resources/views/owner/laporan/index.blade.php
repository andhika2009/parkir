@extends('layout.layout')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white fw-bold fs-5">
            📄 Laporan & Rekapitulasi Pembayaran Parkir
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>No. Struk / Kode</th>
                            <th>Plat Nomor</th>
                            <th>Waktu & Tanggal</th>
                            <th>Petugas</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporan as $item)
                        @php $row = (object) $item; @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>TRX-{{ $row->id_transaksi ?? $row->id ?? '-' }}</td>
                            <td class="fw-bold">{{ $row->no_plat ?? $row->plat_nomor ?? 'N/A' }}</td>
                            <td>{{ $row->waktu_masuk ?? $row->created_at ?? '-' }}</td>
                            <td>{{ $row->petugas ?? 'Petugas' }}</td>
                            <td>Rp {{ number_format($row->total_bayar ?? $row->bayar ?? $row->tarif_per_jam ?? 0, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-{{ ($row->status ?? '') == 'Selesai' ? 'success' : 'warning' }}">
                                    {{ $row->status ?? 'Aktif' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada data transaksi pembayaran parkir.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection