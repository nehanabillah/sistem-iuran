<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            'no_rumah' => ['required', 'string', 'max:50'],
            'rt' => ['required', 'string', 'max:5'],
            'no_wa' => ['required', 'string', 'max:20'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'no_rumah' => $request->no_rumah,
            'rt' => $request->rt,
            'no_wa' => $request->no_wa,
            'role' => 'warga',
            'status' => 'pending', // Paksa status jadi pending
        ]);

        // Catatan: Baris login otomatis (Auth::login) dihapus agar warga tidak bisa langsung masuk

        return redirect()->route('login')->with('status', 'Pendaftaran berhasil! Silakan tunggu persetujuan dari Ketua RT sebelum bisa login.');
    }
}
