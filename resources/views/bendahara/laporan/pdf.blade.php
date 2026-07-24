<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan Bumi Agung - {{ $namaBulan }}</title>
    <style>
        /* CSS Klasik khusus untuk DomPDF */
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11pt;
            color: #2D2620; /* Warna teks lofi dark brown */
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }

        /* Kop Surat (Header) */
        .kop-surat {
            text-align: center;
            border-bottom: 3px solid #D98359; /* Aksen Terracotta Lofi */
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .kop-surat h1 {
            margin: 0;
            font-size: 22pt;
            text-transform: uppercase;
            color: #2D2620;
            letter-spacing: 2px;
        }
        .kop-surat p {
            margin: 5px 0 0 0;
            color: #8C7A6B;
            font-size: 10pt;
        }

        /* Judul Laporan */
        .judul-laporan {
            text-align: center;
            margin-bottom: 30px;
        }
        .judul-laporan h2 {
            margin: 0;
            font-size: 14pt;
            text-decoration: underline;
        }
        .judul-laporan p {
            margin: 5px 0 0 0;
            font-style: italic;
        }

        /* Bagian Tabel */
        .section-box {
            margin-bottom: 30px;
        }
        .section-title {
            font-size: 11pt;
            font-weight: bold;
            margin-bottom: 10px;
            background-color: #E8D9C5; /* Latar Krem Lofi */
            padding: 8px 12px;
            border-left: 5px solid #D98359; /* Garis tepi oranye */
            border-radius: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #D1C7BD;
            padding: 8px 10px;
            text-align: left;
            font-size: 10pt;
        }
        th {
            background-color: #FDFBF7;
            color: #8C7A6B;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9pt;
            text-align: center;
        }

        /* Utility Classes */
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; }
        .text-red { color: #DC2626; }
        .text-green { color: #059669; }

        /* Box Rekapitulasi */
        .summary-box {
            margin-top: 20px;
            border: 2px solid #E8D9C5;
            border-radius: 8px;
            padding: 15px;
            width: 320px;
            float: right;
            background-color: #FDFBF7;
        }
        .summary-item {
            margin-bottom: 8px;
            font-size: 11pt;
        }
        .summary-total {
            font-weight: bold;
            font-size: 13pt;
            border-top: 2px dashed #D1C7BD;
            padding-top: 10px;
            margin-top: 10px;
            color: #2D2620;
        }

        /* Tanda Tangan */
        .footer-ttd {
            clear: both; /* Penting agar tidak menabrak summary-box yang float right */
            margin-top: 80px;
            width: 100%;
        }
        .ttd-box {
            float: right;
            width: 250px;
            text-align: center;
        }
        .ttd-nama {
            margin-top: 70px;
            font-weight: bold;
            text-decoration: underline;
            font-size: 11pt;
        }
    </style>
</head>
<body>

    <!-- Kop Surat Resmi -->
    <div class="kop-surat">
        <h1>BUMI AGUNG</h1>
        <p>Sistem Informasi & Manajemen Keuangan Warga</p>
    </div>

    <!-- Judul Dokumen -->
    <div class="judul-laporan">
        <h2>LAPORAN ARUS KAS BULANAN</h2>
        <p>Periode: Bulan {{ $namaBulan }}</p>
    </div>

    <!-- Tabel 1: Pemasukan -->
    <div class="section-box">
        <div class="section-title">A. Rincian Pemasukan Iuran Warga</div>
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="35%">Nama Warga</th>
                    <th width="15%">Blok/Rumah</th>
                    <th width="25%">Tanggal Validasi</th>
                    <th class="text-right" width="20%">Nominal (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pemasukan as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td class="text-center">{{ $item->user->no_rumah }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($item->paid_at)->format('d/m/Y H:i') }}</td>
                    <td class="text-right font-bold text-green">{{ number_format($item->total_tagihan, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center" style="padding: 20px; color: #8C7A6B;">Tidak ada catatan pemasukan iuran di bulan ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tabel 2: Pengeluaran -->
    <div class="section-box">
        <div class="section-title">B. Rincian Pengeluaran Kas (Operasional)</div>
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="15%">Tanggal</th>
                    <th width="60%">Keterangan Keperluan</th>
                    <th class="text-right" width="20%">Nominal (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengeluaran as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td class="text-right font-bold text-red">{{ number_format($item->nominal, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center" style="padding: 20px; color: #8C7A6B;">Tidak ada catatan pengeluaran kas di bulan ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Kotak Rekapitulasi Akhir -->
    <div class="summary-box">
        <div class="summary-item">Total Pemasukan: <span class="font-bold text-green" style="float:right">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</span></div>
        <div class="summary-item">Total Pengeluaran: <span class="font-bold text-red" style="float:right">- Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</span></div>
        <div class="summary-total">Saldo Bulan Ini: <span style="float:right">Rp {{ number_format($saldo, 0, ',', '.') }}</span></div>
    </div>

    <!-- Area Tanda Tangan -->
    <div class="footer-ttd">
        <div class="ttd-box">
            <p>Batam, {{ date('d F Y') }}</p>
            <p style="margin-top: 5px;">Bendahara Perumahan</p>

            <!-- Ruang kosong untuk tanda tangan basah/cap -->
            <div class="ttd-nama">{{ auth()->user()->name ?? 'Pengurus' }}</div>
        </div>
    </div>

</body>
</html>
