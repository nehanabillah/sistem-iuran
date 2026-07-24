<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\MasterIuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MasterIuranController extends Controller
{
    public function index()
    {
        $iurans = MasterIuran::orderBy('created_at', 'desc')->get();
        return view('bendahara.master-iuran.index', compact('iurans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_iuran' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
        ]);

        MasterIuran::create([
            'nama_iuran' => $request->nama_iuran,
            'nominal' => $request->nominal,
            'is_active' => $request->has('is_active'), // Ceklist aktif
        ]);

        // Hapus memori cache agar BillingService menggunakan tarif terbaru bulan depan
        Cache::forget('active_master_iurans');

        return redirect()->back()->with('success', 'Komponen iuran baru berhasil ditambahkan!');
    }

    public function edit(MasterIuran $masterIuran)
    {
        return view('bendahara.master-iuran.edit', compact('masterIuran'));
    }

    public function update(Request $request, MasterIuran $masterIuran)
    {
        $request->validate([
            'nama_iuran' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
        ]);

        $masterIuran->update([
            'nama_iuran' => $request->nama_iuran,
            'nominal' => $request->nominal,
            'is_active' => $request->has('is_active'),
        ]);

        Cache::forget('active_master_iurans');

        return redirect()->route('bendahara.master-iuran.index')->with('success', 'Data komponen iuran berhasil diperbarui!');
    }

    public function destroy(MasterIuran $masterIuran)
    {
        $masterIuran->delete();
        Cache::forget('active_master_iurans');

        return redirect()->back()->with('success', 'Komponen iuran berhasil dihapus!');
    }
}
