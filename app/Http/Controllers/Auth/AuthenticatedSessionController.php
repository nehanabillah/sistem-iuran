<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

/**
     * Handle an incoming authentication request.
     */
/**
     * Handle an incoming authentication request.
     */
/**
     * Handle an incoming authentication request.
     */
        public function store(LoginRequest $request): RedirectResponse
    {
        // 1. Proses validasi email & password bawaan Laravel
        $request->authenticate();

        $user = $request->user();

        // 2. CEK STATUS: Jika Warga masih pending/nonaktif, tendang keluar!
        if ($user->role === 'warga' && $user->status !== 'aktif') {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Format nomor RT agar selalu dua digit (contoh: 01, 02)
            $nomorRT = str_pad($user->rt, 2, '0', STR_PAD_LEFT);

            $pesanError = $user->status === 'pending'
                ? "Akun Anda sedang menunggu verifikasi dari Ketua RT {$nomorRT}. Harap bersabar."
                : 'Akun Anda telah dinonaktifkan (Pindah/Keluar).';

            return redirect('/login')->with('error', $pesanError);
        }

        // 3. Jika aman, buat session login
        $request->session()->regenerate();

        // 4. REDIRECT PINTAR: Arahkan ke dasbor masing-masing role
        return match ($user->role) {
            'rt' => redirect()->route('rt.dashboard'),
            'rw' => redirect()->route('rw.dashboard'),
            'bendahara' => redirect()->route('bendahara.dashboard'),
            default => redirect()->route('warga.dashboard'), // Default untuk Warga
        };
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
