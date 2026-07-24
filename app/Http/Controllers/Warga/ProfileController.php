<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('warga.profil.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        // 1. Validasi semua data yang masuk
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'no_wa' => ['required', 'string', 'max:20'],
            'no_rumah' => ['required', 'string', 'max:50'],
        ]);

        // 2. Simpan semua perubahan ke database
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_wa' => $request->no_wa,
            'no_rumah' => $request->no_rumah,
        ]);

        return back()->with('success', 'Informasi profil berhasil diperbarui!');
    }
}
