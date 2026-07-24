<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\KasKeluar;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung data secara langsung (real-time) tanpa Cache
        // agar angka selalu akurat setiap kali halaman dibuka.
        $pemasukan = Invoice::where('status', 'paid')->sum('total_tagihan');
        $pengeluaran = KasKeluar::sum('nominal');
        $saldo = $pemasukan - $pengeluaran;
        $tunggakan = Invoice::where('status', 'unpaid')->sum('total_tagihan');

        return view('bendahara.dashboard', [
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'saldo' => $saldo,
            'tunggakan' => $tunggakan,
        ]);
    }
}
