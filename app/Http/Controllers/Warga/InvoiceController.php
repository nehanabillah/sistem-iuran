<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Services\MidtransService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function bayar(Invoice $invoice, MidtransService $midtrans)
    {
        // Pastikan invoice milik user yang sedang login
        if ($invoice->user_id !== auth()->id()) {
            abort(403);
        }

        $snapToken = $midtrans->getSnapToken($invoice);
        $invoice->update(['snap_token' => $snapToken]);

        return view('warga.tagihan.bayar', compact('invoice', 'snapToken'));
    }

    public function lapor(Invoice $invoice)
    {
        if ($invoice->user_id !== auth()->id() || $invoice->status === 'paid') {
            abort(403, 'Akses tidak valid.');
        }

        return view('warga.tagihan.lapor', compact('invoice'));
    }

    public function storeLapor(Request $request, Invoice $invoice)
    {
        $request->validate([
            'bukti' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan file ke storage/app/public/bukti_bayar
        $path = $request->file('bukti')->store('bukti_bayar', 'public');

        // Update database dengan memaksa status menjadi pending
        $invoice->update([
            'status' => 'pending',
            'payment_method' => 'manual',
            'bukti_pembayaran' => $path,
        ]);

        return redirect()->route('warga.dashboard')->with('success', 'Bukti berhasil diunggah!');
    }
}
