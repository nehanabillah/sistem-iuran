<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kuitansi {{ $invoice->invoice_number }}</title>
    <style>
        body { font-family: 'Arial', sans-serif; padding: 20px; color: #333; }
        .kuitansi-box { border: 2px dashed #888; padding: 30px; border-radius: 10px; position: relative; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h1 { margin: 0; color: #d4a373; text-transform: uppercase; letter-spacing: 2px; }
        .info-table { width: 100%; margin-bottom: 20px; font-size: 14px; }
        .info-table td { padding: 8px 0; }
        .info-table td:first-child { width: 150px; font-weight: bold; }
        .total-box { background-color: #f9f9f9; padding: 15px; font-size: 20px; font-weight: bold; text-align: center; border: 1px solid #ddd; margin-top: 20px; }
        .stamp { position: absolute; right: 50px; bottom: 30px; color: #28a745; font-size: 24px; font-weight: bold; border: 3px solid #28a745; padding: 10px 20px; transform: rotate(-10deg); opacity: 0.7; }
    </style>
</head>
<body>
    <div class="kuitansi-box">
        <div class="header">
            <h1>KUITANSI PEMBAYARAN IURAN</h1>
            <p style="margin:5px 0 0 0;">Perumahan Bumi Agung</p>
        </div>

        <table class="info-table">
            <tr>
                <td>No. Kuitansi/Invoice</td>
                <td>: {{ $invoice->invoice_number }}</td>
            </tr>
            <tr>
                <td>Telah Diterima Dari</td>
                <td>: <strong>{{ $invoice->user->name }}</strong> (Blok {{ $invoice->user->no_rumah }})</td>
            </tr>
            <tr>
                <td>Untuk Pembayaran</td>
                <td>: Iuran Warga Periode Bulan {{ \Carbon\Carbon::parse($invoice->bulan_tagihan)->translatedFormat('F Y') }}</td>
            </tr>
            <tr>
                <td>Tanggal Bayar</td>
                <td>: {{ \Carbon\Carbon::parse($invoice->paid_at)->format('d F Y, H:i') }} WIB</td>
            </tr>
            <tr>
                <td>Metode Pembayaran</td>
                <td>: {{ strtoupper($invoice->payment_method) }}</td>
            </tr>
        </table>

        <div class="total-box">
            TOTAL: Rp {{ number_format($invoice->total_tagihan, 0, ',', '.') }}
        </div>

        <div class="stamp">
            LUNAS
        </div>
</div>
</body>
</html>
