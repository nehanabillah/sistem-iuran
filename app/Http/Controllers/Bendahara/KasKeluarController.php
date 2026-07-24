<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\KasKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class KasKeluarController extends Controller
{
    public function index()
    {
        // Mengambil semua data pengeluaran, diurutkan dari yang terbaru
        $kasKeluars = KasKeluar::orderBy('tanggal', 'desc')->orderBy('created_at', 'desc')->get();
        return view('bendahara.kas-keluar.index', compact('kasKeluars'));
    }

        public function store(Request $request)
    {
        $request->validate([
            'tanggal'    => 'required|date',
            'keterangan' => 'required|string|max:255',
            'nominal'    => 'required|numeric',
        ]);

        // Menyimpan data dengan menyertakan user_id
        KasKeluar::create([
            'tanggal'    => $request->tanggal,
            'keterangan' => $request->keterangan,
            'nominal'    => $request->nominal,
            'user_id'    => Auth::id(), // Menangkap ID Bendahara yang sedang login
        ]);

        return redirect()->route('bendahara.kas-keluar.index')
                         ->with('success', 'Data kas keluar berhasil disimpan.');
    }

    public function destroy(KasKeluar $kasKeluar)
    {
        // Hapus data jika terjadi kesalahan input
        $kasKeluar->delete();

        return redirect()->back()->with('success', 'Data pengeluaran berhasil dihapus!');
    }
}
