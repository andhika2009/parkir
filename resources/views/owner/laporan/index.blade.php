@extends('layout.layout')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-file-earmark-text"></i> Laporan & Rekapitulasi Pembayaran Parkir</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th>No. Struk / Kode</th>
                        <th>Plat Nomor</th>
                        <th>Waktu & Tanggal</th>
                        <th>Petugas</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporans as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <span class="badge bg-secondary">
                                    #{{ $item->no_struk ?? $item->kode_transaksi ?? $item->id_parkir ?? $item->id ?? ($index + 1) }}
                                </span>
                            </td>
                            <td><strong>{{ $item->plat_nomor ?? '-' }}</strong></td>
                            <td>{{ isset($item->created_at) ? \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') : '-' }}</td>
                            <td>{{ $item->nama_petugas ?? 'petugas' }}</td>
                            <td class="fw-bold text-success">
                                Rp {{ number_format($item->total_bayar ?? $item->biaya ?? $item->bayar ?? 0, 0, ',', '.') }}
                            </td>
                            <td><span class="badge bg-success">Lunas</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada data transaksi pembayaran parkir.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection