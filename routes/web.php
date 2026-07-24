<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// --- Controllers ---
use App\Http\Controllers\Warga\{DashboardController as WargaDashboard, InvoiceController as WargaInvoice, ProfileController as WargaProfile, RiwayatController as WargaRiwayat};
use App\Http\Controllers\RT\{DashboardController as RTDashboard, ApprovalController as RTApproval};
use App\Http\Controllers\RW\DashboardController as RWDashboard;
use App\Http\Controllers\Bendahara\{DashboardController as BendaharaDashboard, TagihanController as BendaharaTagihan, KasKeluarController, LaporanController, MasterIuranController};
use App\Http\Controllers\Webhook\MidtransWebhookController;

// --- Landing Page ---
Route::get('/', function () {
    // Jika user sudah login, langsung arahkan ke dasbor masing-masing
    if (auth()->check()) {
        $role = auth()->user()->role;
        return match ($role) {
            'rt' => redirect()->route('rt.dashboard'),
            'rw' => redirect()->route('rw.dashboard'),
            'bendahara' => redirect()->route('bendahara.dashboard'),
            default => redirect()->route('warga.dashboard'),
        };
    }
    // Jika belum login, tampilkan Landing Page
    return view('welcome');
});

// --- Routing Warga ---
Route::prefix('warga')->middleware(['auth', 'role:warga'])->group(function () {
    Route::get('/dashboard', [WargaDashboard::class, 'index'])->name('warga.dashboard');
    Route::get('/tagihan/{invoice}/bayar', [WargaInvoice::class, 'bayar'])->name('warga.tagihan.bayar');

    // Profil
    Route::get('/profil', [WargaProfile::class, 'index'])->name('warga.profil');
    Route::put('/profil', [WargaProfile::class, 'update'])->name('warga.profil.update');

    // Riwayat
    Route::get('/riwayat', [WargaRiwayat::class, 'index'])->name('warga.riwayat.index');
    Route::get('/riwayat/{invoice}/kuitansi', [WargaRiwayat::class, 'cetakKuitansi'])->name('warga.riwayat.kuitansi');

    // Lapor Bayar
    Route::get('/tagihan/{invoice}/lapor', [WargaInvoice::class, 'lapor'])->name('warga.tagihan.lapor');
    Route::post('/tagihan/{invoice}/lapor', [WargaInvoice::class, 'storeLapor'])->name('warga.tagihan.store-lapor');
    // Pastikan rute ini berada di dalam group middleware 'warga'
    Route::get('/riwayat/{invoice}/cetak', [WargaRiwayat::class, 'cetakKuitansi'])->name('warga.riwayat.cetak');
});

// --- Routing RT ---
Route::prefix('rt')->middleware(['auth', 'role:rt'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\RT\DashboardController::class, 'index'])->name('rt.dashboard');

    // Fitur Persetujuan (Approval)
    Route::get('/warga/approval', [\App\Http\Controllers\RT\ApprovalController::class, 'index'])->name('rt.approval.index');
    Route::patch('/warga/approval/{user}/approve', [\App\Http\Controllers\RT\ApprovalController::class, 'approve'])->name('rt.approval.approve');
    Route::delete('/warga/approval/{user}/reject', [\App\Http\Controllers\RT\ApprovalController::class, 'reject'])->name('rt.approval.reject');

    // Fitur Manajemen Data Warga
    Route::resource('/warga', \App\Http\Controllers\RT\WargaController::class)->names('rt.warga')->except(['create', 'store', 'show']);
});

// --- Routing RW ---
Route::prefix('rw')->middleware(['auth', 'role:rw'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\RW\DashboardController::class, 'index'])->name('rw.dashboard');

    // Fitur Data Warga Global
    Route::get('/warga', [\App\Http\Controllers\RW\WargaController::class, 'index'])->name('rw.warga.index');

    // Fitur Arsip Laporan
    Route::get('/laporan', [\App\Http\Controllers\RW\LaporanController::class, 'index'])->name('rw.laporan.index');
    Route::get('/laporan/pdf', [\App\Http\Controllers\RW\LaporanController::class, 'cetakPDF'])->name('rw.laporan.pdf');
});

// --- Routing Bendahara ---
Route::prefix('bendahara')->middleware(['auth', 'role:bendahara'])->group(function () {
    Route::get('/dashboard', [BendaharaDashboard::class, 'index'])->name('bendahara.dashboard');

    // Manajemen Tagihan
    Route::get('/tagihan', [BendaharaTagihan::class, 'index'])->name('bendahara.tagihan.index');
    Route::post('/tagihan/{invoice}/tandai-lunas', [BendaharaTagihan::class, 'tandaiLunas'])->name('bendahara.tagihan.tandai-lunas');
    Route::post('/tagihan/{invoice}/validasi', [BendaharaTagihan::class, 'validasi'])->name('bendahara.tagihan.validasi');

    // Kas Keluar
    Route::controller(KasKeluarController::class)->group(function () {
        Route::get('/kas-keluar', 'index')->name('bendahara.kas-keluar.index');
        Route::post('/kas-keluar', 'store')->name('bendahara.kas-keluar.store');
        Route::delete('/kas-keluar/{kasKeluar}', 'destroy')->name('bendahara.kas-keluar.destroy');
    });

    // Laporan & Master Iuran
    Route::get('/laporan/pdf', [LaporanController::class, 'cetakPDF'])->name('bendahara.laporan.pdf');
    Route::resource('/master-iuran', MasterIuranController::class)
         ->names('bendahara.master-iuran')
         ->except(['create', 'show']);
});

// --- Auth & Profile ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/webhook/midtrans', [MidtransWebhookController::class, 'handle']);
require __DIR__.'/auth.php';
