<?php

namespace App\Http\Controllers\RT;

use App\Http\Controllers\Controller;
use App\Models\User;

class ApprovalController extends Controller
{
    public function index()
    {
        $rt_id = auth()->user()->rt;
        $pendingWarga = User::where('role', 'warga')
            ->where('rt', $rt_id)
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('rt.approval.index', compact('pendingWarga'));
    }

    public function approve(User $user)
    {
        $user->update(['status' => 'aktif']);
        return redirect()->back()->with('success', 'Akun warga berhasil disetujui. Warga kini bisa login!');
    }

    public function reject(User $user)
    {
        $user->delete(); // Hapus akun yang tidak valid dari database
        return redirect()->back()->with('success', 'Pendaftaran warga ditolak dan data dihapus.');
    }
}
