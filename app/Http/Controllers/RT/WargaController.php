<?php

namespace App\Http\Controllers\RT;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index()
    {
        $rt_id = auth()->user()->rt;
        // Ambil warga yang sudah tidak pending (aktif atau nonaktif)
        $wargas = User::where('role', 'warga')
            ->where('rt', $rt_id)
            ->where('status', '!=', 'pending')
            ->orderBy('no_rumah', 'asc')
            ->get();

        return view('rt.warga.index', compact('wargas'));
    }

    public function edit(User $warga)
    {
        return view('rt.warga.edit', compact('warga'));
    }

    public function update(Request $request, User $warga)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'no_rumah' => 'required|string|max:50',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $warga->update([
            'name' => $request->name,
            'no_rumah' => $request->no_rumah,
            'status' => $request->status,
        ]);

        return redirect()->route('rt.warga.index')->with('success', 'Data warga berhasil diperbarui!');
    }

    public function destroy(User $warga)
    {
        $warga->delete();
        return redirect()->back()->with('success', 'Data warga berhasil dihapus permanen.');
    }
}
