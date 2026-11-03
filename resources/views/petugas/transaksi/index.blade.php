@extends('layout.layout')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-4">Operasional Transaksi Parkir</h3>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white fw-bold">
            Data Kendaraan Dalam Area Parkir (Aktif)
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>No Plat</th>
                            <th>Jenis</th>
                            <th width="35%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataTampil as $item)
                        @php 
                            $row = (object) $item;
                            $plat = !empty($row->no_plat) && $row->no_plat !== '-' ? $row->no_plat : 'N/A';
                            $jenis = $row->jenis_kendaraan ?? 'Lainnya';
                            $waktu = $row->waktu_masuk ?? now()->format('Y-m-d H:i:s');
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $plat }}</td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $jenis }}
                                </span>
                            </td>
                            <td class="text-center">
                                <button type="button" 
                                        class="btn btn-success btn-sm fw-semibold"
                                        onclick="bukaStruk('{{ $loop->iteration }}', '{{ $plat }}', '{{ $jenis }}', '{{ $waktu }}')">
                                    🖨️ Cetak Struk
                                </button>
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

<!-- Modal Struk Thermal -->
<div class="modal fade" id="modalStruk" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Struk Parkir</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="areaCetakStruk" style="font-family: monospace; font-size: 13px; background: #fff8e7; padding: 15px; border: 1px dashed #000; border-radius: 4px;">
                    <div style="text-align: center; font-weight: bold; font-size: 16px; margin-bottom: 5px;">SISTEM PARKIR</div>
                    <div style="text-align: center; border-bottom: 1px dashed #000; padding-bottom: 5px; margin-bottom: 10px;">===================</div>
                    <table width="100%" style="font-family: monospace;">
                        <tr><td>No. Urut</td><td>: <span id="sNo"></span></td></tr>
                        <tr><td>No. Plat</td><td>: <span id="sPlat" style="font-weight: bold;"></span></td></tr>
                        <tr><td>Jenis</td><td>: <span id="sJenis"></span></td></tr>
                        <tr><td>Masuk</td><td>: <span id="sWaktu"></span></td></tr>
                    </table>
                    <div style="text-align: center; border-top: 1px dashed #000; margin-top: 10px; padding-top: 5px;">
                        Simpan struk ini sebagai bukti parkir.<br>Terima Kasih!
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="eksekusiCetak()">Cetak Sekarang</button>
            </div>
        </div>
    </div>
</div>

<!-- Script Modal & Cetak -->
<script>
function bukaStruk(no, plat, jenis, waktu) {
    document.getElementById('sNo').innerText = no;
    document.getElementById('sPlat').innerText = plat;
    document.getElementById('sJenis').innerText = jenis.toUpperCase();
    document.getElementById('sWaktu').innerText = waktu;
    
    let modal = new bootstrap.Modal(document.getElementById('modalStruk'));
    modal.show();
}

function eksekusiCetak() {
    let isi = document.getElementById('areaCetakStruk').innerHTML;
    let win = window.open('', '', 'height=500,width=400');
    win.document.write('<html><head><title>Cetak Struk</title></head><body>');
    win.document.write(isi);
    win.document.write('</body></html>');
    win.document.close();
    win.print();
}
</script>
@endsection