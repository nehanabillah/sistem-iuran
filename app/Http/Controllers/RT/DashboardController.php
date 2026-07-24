<?php

namespace App\Http\Controllers\RT;

use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil ID RT dari user yang sedang login
        $rt_id = auth()->user()->rt;

        // Hitung statistik warga di RT tersebut
        $totalWarga = User::where('role', 'warga')->where('rt', $rt_id)->where('status', 'aktif')->count();
        $wargaPending = User::where('role', 'warga')->where('rt', $rt_id)->where('status', 'pending')->count();
        $wargaNonaktif = User::where('role', 'warga')->where('rt', $rt_id)->where('status', 'nonaktif')->count();

        // Ambil 5 warga terbaru yang butuh approval
        $pendingList = User::where('role', 'warga')
            ->where('rt', $rt_id)
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('rt.dashboard', compact('totalWarga', 'wargaPending', 'wargaNonaktif', 'pendingList'));
    }
}
