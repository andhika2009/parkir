@extends('layout.layout')

@section('title', 'Log Aktivitas')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="m-0 fw-bold"><i class="bi bi-clock-history me-2 text-primary"></i>Riwayat Log Aktivitas Sistem</h5>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th width="5%">No</th>
                    <th>Waktu</th>
                    <th>Pengguna</th>
                    <th>Aktivitas</th>
                    <th>IP Address</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $index => $log)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><small class="text-muted">{{ $log->created_at->format('d M Y H:i:s') }}</small></td>
                    <td><strong>{{ $log->user->name ?? 'Sistem / Guest' }}</strong></td>
                    <td>{{ $log->aktivitas }}</td>
                    <td><code>{{ $log->ip_address ?? '-' }}</code></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">Belum ada catatan log aktivitas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection