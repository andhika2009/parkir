```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Parkir</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eee;
            padding: 20px;
        }

        .struk {
            width: 300px;
            margin: auto;
            padding: 20px;
            background: white;
            color: black;
        }

        h2, .center {
            text-align: center;
        }

        hr {
            border: none;
            border-top: 1px dashed black;
        }

        .row {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin: 10px 0;
            font-size: 13px;
        }

        .total {
            font-size: 17px;
            font-weight: bold;
        }

        button {
            display: block;
            margin: 20px auto;
            padding: 12px 25px;
            background: #0d6efd;
            color: white;
            border: none;
            cursor: pointer;
        }

        @media print {
            body { background: white; padding: 0; }
            button { display: none; }
            .struk { margin: 0 auto; }
            @page { size: 80mm auto; margin: 5mm; }
        }
    </style>
</head>
<body>

<div class="struk">
    <h2>SISTEM PARKIR</h2>
    <p class="center">BUKTI PEMBAYARAN PARKIR</p>
    <hr>

   <div class="row">
    <span>No. Transaksi</span>
    <strong>TRX-{{ str_pad($trx->getKey(), 5, '0', STR_PAD_LEFT) }}</strong>
</div>

    <div class="row">
        <span>Plat Nomor</span>
        <b>{{ $trx->kendaraan->plat_nomer ?? '-' }}</b>
    </div>

    <div class="row">
        <span>Jenis Kendaraan</span>
        <span>{{ $trx->kendaraan->jenis_kendaraan ?? '-' }}</span>
    </div>

    <div class="row">
        <span>Area Parkir</span>
        <span>{{ $trx->area->nama_area ?? '-' }}</span>
    </div>

    <hr>

    <div class="row">
        <span>Waktu Masuk</span>
        <span>{{ $waktuMasuk->format('d/m/Y H:i') }}</span>
    </div>

    <div class="row">
        <span>Waktu Keluar</span>
        <span>{{ $waktuKeluar->format('d/m/Y H:i') }}</span>
    </div>

    <div class="row">
        <span>Durasi</span>
        <span>{{ $durasiJam }} Jam</span>
    </div>

    <hr>

    <div class="row total">
        <span>TOTAL</span>
        <span>Rp {{ number_format($trx->biaya_total, 0, ',', '.') }}</span>
    </div>

    <hr>
    <p class="center">Terima kasih telah parkir di tempat kami.</p>
    <p class="center">Simpan struk ini sebagai bukti pembayaran.</p>
</div>

<button onclick="window.print()">CETAK STRUK</button>

</body>
</html>
```