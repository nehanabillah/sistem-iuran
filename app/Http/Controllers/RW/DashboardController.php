<?php

namespace App\Http\Controllers\Rw;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Invoice;
use App\Models\KasKeluar;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        // Gunakan Cache 5 menit agar dasbor RW loadingnya super cepat
        $statistik = Cache::remember('rw_dashboard_stats', 300, function () {
            $pemasukan = Invoice::where('status', 'paid')->sum('total_tagihan');
            $pengeluaran = KasKeluar::sum('nominal');

            return [
                'total_warga' => User::where('role', 'warga')->count(),
                'warga_aktif' => User::where('role', 'warga')->where('status', 'aktif')->count(),
                'pemasukan' => $pemasukan,
                'pengeluaran' => $pengeluaran,
                'saldo' => $pemasukan - $pengeluaran,
                'tunggakan' => Invoice::where('status', 'unpaid')->sum('total_tagihan'),
            ];
        });

        // Ambil 5 aktivitas transaksi terakhir (kas masuk atau keluar) untuk dipantau RW
        $transaksiTerakhir = Invoice::with('user')
            ->where('status', 'paid')
            ->orderBy('paid_at', 'desc')
            ->take(5)
            ->get();

        return view('rw.dashboard', compact('statistik', 'transaksiTerakhir'));
    }
}
