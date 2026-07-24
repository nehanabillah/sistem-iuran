<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Mengambil tagihan yang statusnya belum dibayar (unpaid)
        $tagihanBelumDibayar = $user->invoices()->where('status', 'unpaid')->get();
        $totalTunggakan = $tagihanBelumDibayar->sum('total_tagihan');

        // Mengambil 5 riwayat pembayaran terakhir yang sudah lunas (paid)
        $riwayatPembayaran = $user->invoices()
                                  ->where('status', 'paid')
                                  ->latest('paid_at')
                                  ->take(5)
                                  ->get();

        return view('warga.dashboard', compact('user', 'tagihanBelumDibayar', 'totalTunggakan', 'riwayatPembayaran'));
    }
}
