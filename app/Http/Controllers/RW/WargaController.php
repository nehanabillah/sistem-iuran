<?php

namespace App\Http\Controllers\RW;

use App\Http\Controllers\Controller;
use App\Models\User;

class WargaController extends Controller
{
    public function index()
    {
        // RW dapat melihat semua warga dari seluruh RT, diurutkan berdasarkan RT lalu Nomor Rumah
        $wargas = User::where('role', 'warga')
            ->orderBy('rt', 'asc')
            ->orderBy('no_rumah', 'asc')
            ->get();

        return view('rw.warga.index', compact('wargas'));
    }
}
