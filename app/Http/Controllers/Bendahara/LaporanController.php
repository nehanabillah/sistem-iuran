<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\KasKeluar;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function cetakPDF(Request $request)
    {
        // Ambil parameter bulan dari request, atau default ke bulan ini
        $bulanParam = $request->get('bulan', Carbon::now()->format('Y-m'));
        $namaBulan = Carbon::parse($bulanParam)->translatedFormat('F Y');

        // 1. Ambil data Pemasukan (Tagihan Lunas di bulan tersebut)
        $pemasukan = Invoice::with('user')
            ->where('status', 'paid')
            ->where('bulan_tagihan', $bulanParam)
            ->get();
        $totalPemasukan = $pemasukan->sum('total_tagihan');

        // 2. Ambil data Pengeluaran (Kas Keluar di bulan tersebut)
        $pengeluaran = KasKeluar::whereYear('tanggal', Carbon::parse($bulanParam)->year)
            ->whereMonth('tanggal', Carbon::parse($bulanParam)->month)
            ->get();
        $totalPengeluaran = $pengeluaran->sum('nominal');

        // 3. Hitung Saldo Bulan Ini
        $saldo = $totalPemasukan - $totalPengeluaran;

        // Render data ke PDF
        $pdf = Pdf::loadView('bendahara.laporan.pdf', compact(
            'namaBulan', 'pemasukan', 'pengeluaran', 'totalPemasukan', 'totalPengeluaran', 'saldo'
        ));

        // Setting ukuran kertas A4 Portrait
        $pdf->setPaper('a4', 'portrait');

        // Ganti 'download' menjadi 'stream' agar terbuka di browser (Preview)
        return $pdf->stream('Laporan_Keuangan_Bumi_Agung_' . str_replace(' ', '_', $namaBulan) . '.pdf');
    }
}
