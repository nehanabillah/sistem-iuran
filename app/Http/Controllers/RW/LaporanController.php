<?php

namespace App\Http\Controllers\RW;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\KasKeluar;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        // AMBIL DATA INVOICE DARI DATABASE
        // Menggunakan 'with('user')' agar data relasi nama warga ikut terbawa
        // Menggunakan 'latest()' agar tagihan terbaru muncul di atas
        $invoices = Invoice::with('user')->latest()->get();

        // KIRIM DATA KE VIEW menggunakan compact()
        return view('rw.laporan.index', compact('invoices'));
    }

    public function cetakPDF()
    {
        $bulanIni = Carbon::now()->format('Y-m');
        $namaBulan = Carbon::now()->translatedFormat('F Y');

        // Kalkulasi Pemasukan (Invoice Lunas Bulan Ini)
        $pemasukan = Invoice::where('status', 'paid')
            ->where('updated_at', 'like', $bulanIni . '%')
            ->get();
        $totalPemasukan = $pemasukan->sum('total_tagihan');

        // Kalkulasi Pengeluaran (Kas Keluar Bulan Ini)
        $pengeluaran = KasKeluar::where('tanggal', 'like', $bulanIni . '%')->get();
        $totalPengeluaran = $pengeluaran->sum('nominal');

        // Saldo Bersih
        $saldo = $totalPemasukan - $totalPengeluaran;

        $pdf = Pdf::loadView('bendahara.laporan.pdf', compact(
            'namaBulan', 'pemasukan', 'totalPemasukan', 'pengeluaran', 'totalPengeluaran', 'saldo'
        ));

        // Format kertas A4
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('Laporan_Keuangan_RW_' . $namaBulan . '.pdf');
    }
}
