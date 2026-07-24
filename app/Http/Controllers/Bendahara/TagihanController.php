<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Services\FonnteService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TagihanController extends Controller
{
    public function index()
    {
        // Ambil tagihan, urutkan yang 'pending' di paling atas agar Bendahara langsung notice
        $invoices = Invoice::with('user')
            ->orderByRaw("FIELD(status, 'pending', 'unpaid', 'paid')")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('bendahara.tagihan.index', compact('invoices'));
    }

    public function tandaiLunas(Invoice $invoice, FonnteService $fonnte)
    {
        if ($invoice->status === 'paid') {
            return redirect()->back()->with('success', 'Tagihan ini memang sudah lunas.');
        }

        $invoice->update([
            'status' => 'paid',
            'payment_method' => 'manual',
            'paid_by' => auth()->id(),
            'paid_at' => Carbon::now(),
        ]);

        $pesan = "✅ *PEMBAYARAN TUNAI BERHASIL*\n\nTerima kasih Bpk/Ibu {$invoice->user->name}, pembayaran iuran tunai untuk invoice *{$invoice->invoice_number}* sebesar *Rp " . number_format($invoice->total_tagihan, 0, ',', '.') . "* telah dicatat lunas.\n\nSalam,\nPengurus Perumahan";
        $fonnte->sendMessage($invoice->user->no_wa, $pesan);

        return redirect()->back()->with('success', 'Pembayaran tunai berhasil dicatat!');
    }

    // METHOD BARU UNTUK VALIDASI BUKTI TRANSFER
    public function validasi(Request $request, Invoice $invoice, FonnteService $fonnte)
    {
        $request->validate(['action' => 'required|in:terima,tolak']);

        if ($request->action === 'terima') {
            $invoice->update([
                'status' => 'paid',
                'paid_by' => auth()->id(),
                'paid_at' => Carbon::now(),
            ]);

            $pesan = "✅ *VALIDASI BERHASIL*\n\nTerima kasih Bpk/Ibu {$invoice->user->name}, bukti transfer untuk invoice *{$invoice->invoice_number}* telah disetujui. Tagihan Anda kini berstatus LUNAS.\n\nSalam,\nPengurus Perumahan";
            $fonnte->sendMessage($invoice->user->no_wa, $pesan);

            return redirect()->back()->with('success', 'Bukti pembayaran disetujui. Tagihan lunas!');
        }

        if ($request->action === 'tolak') {
            $invoice->update([
                'status' => 'unpaid',
                'payment_method' => null,
                'bukti_pembayaran' => null,
            ]);

            $pesan = "❌ *VALIDASI DITOLAK*\n\nMohon maaf Bpk/Ibu {$invoice->user->name}, bukti transfer untuk invoice *{$invoice->invoice_number}* tidak valid/buram. Silakan unggah ulang bukti yang benar melalui aplikasi.\n\nSalam,\nPengurus Perumahan";
            $fonnte->sendMessage($invoice->user->no_wa, $pesan);

            return redirect()->back()->with('error', 'Bukti pembayaran ditolak. Warga diminta upload ulang.');
        }
    }
}
