<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;

class RiwayatController extends Controller
{
    /**
     * Menampilkan daftar riwayat pembayaran warga.
     */
    public function index()
    {
        // Ambil tagihan yang sudah lunas atau sedang menunggu verifikasi manual
        $riwayat = Invoice::where('user_id', auth()->id())
            ->whereIn('status', ['paid', 'pending'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('warga.riwayat.index', compact('riwayat'));
    }

    /**
     * Mencetak kuitansi untuk invoice tertentu.
     * Menggunakan model binding $invoice yang secara otomatis mencari berdasarkan ID.
     */
    public function cetakKuitansi(Invoice $invoice)
    {
        // Keamanan: Pastikan warga hanya bisa cetak kuitansi miliknya sendiri
        // dan tagihan harus sudah berstatus 'paid' (lunas)
        if ($invoice->user_id !== auth()->id() || $invoice->status !== 'paid') {
            abort(403, 'Akses ditolak atau tagihan belum lunas.');
        }

        // Memuat view kuitansi ke dalam PDF
        $pdf = Pdf::loadView('warga.riwayat.kuitansi', compact('invoice'));

        // Format Kuitansi (disesuaikan menjadi A5 landscape untuk tampilan kuitansi yang pas)
        $pdf->setPaper('A5', 'landscape');

        // Mengirim stream PDF ke browser untuk langsung dilihat atau dicetak
        return $pdf->stream('Kuitansi_' . $invoice->invoice_number . '.pdf');
    }
}
