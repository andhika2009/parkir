<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Parkir #{{ $trx->id_transaksi }}</title>
    <style>
        body { font-family: monospace; width: 300px; margin: 20px auto; font-size: 13px; }
        h3, p { text-align: center; margin: 4px 0; }
        hr { border: none; border-top: 1px dashed #000; }
        table { width: 100%; }
        td:last-child { text-align: right; }
        .total { font-weight: bold; font-size: 15px; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>
    <h3>SISTEM PARKIR</h3>
    <p>Struk Transaksi #{{ $trx->id_transaksi }}</p>
    <hr>
    <table>
        <tr><td>No Plat</td><td>{{ $trx->kendaraan->plat_nomer ?? '-' }}</td></tr>
        <tr><td>Jenis</td><td>{{ $trx->kendaraan->jenis_kendaraan ?? '-' }}</td></tr>
        <tr><td>Area</td><td>{{ $trx->area->nama_area ?? '-' }}</td></tr>
        <tr><td>Masuk</td><td>{{ $trx->waktu_masuk->format('d/m/Y H:i') }}</td></tr>
        <tr><td>Keluar</td><td>{{ $trx->waktu_keluar ? $trx->waktu_keluar->format('d/m/Y H:i') : '-' }}</td></tr>
        <tr><td>Durasi</td><td>{{ $trx->durasi_jam ?? '-' }} jam</td></tr>
        <tr><td>Tarif/jam</td><td>Rp {{ number_format($trx->tarif->tarif_per_jam ?? 0, 0, ',', '.') }}</td></tr>
    </table>
    <hr>
    <table>
        <tr class="total"><td>TOTAL</td><td>Rp {{ number_format($trx->biaya_total ?? 0, 0, ',', '.') }}</td></tr>
    </table>
    <hr>
    <p>Terima kasih</p>
    <p class="no-print">
        <button onclick="window.print()">Cetak</button>
        <a href="javascript:history.back()">Kembali</a>
    </p>
    <script>window.onload = function () { window.print(); };</script>
</body>
</html>