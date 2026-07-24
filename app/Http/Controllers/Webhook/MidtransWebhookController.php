<?php

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Services\FonnteService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MidtransWebhookController extends Controller
{
    public function handle(Request $request, FonnteService $fonnte)
    {
        $payload = $request->all();

        if (!isset($payload['order_id']) || !isset($payload['transaction_status'])) {
            return response()->json(['message' => 'Invalid payload'], 400);
        }

        $orderId = $payload['order_id'];
        $transactionStatus = $payload['transaction_status'];

        $invoice = Invoice::with('user')->where('invoice_number', $orderId)->first();

        if (!$invoice) {
            return response()->json(['message' => 'Invoice tidak ditemukan'], 404);
        }

        if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
            if ($invoice->status !== 'paid') {
                $invoice->update([
                    'status' => 'paid',
                    'payment_method' => 'midtrans',
                    'paid_at' => Carbon::now(),
                ]);

                // Kirim WA Kuitansi Digital
                $pesan = "✅ *PEMBAYARAN BERHASIL*\n\n";
                $pesan .= "Terima kasih Bpk/Ibu {$invoice->user->name}, pembayaran iuran untuk invoice *{$invoice->invoice_number}* sebesar *Rp " . number_format($invoice->total_tagihan, 0, ',', '.') . "* telah kami terima via sistem online (Midtrans).\n\n";
                $pesan .= "Salam,\nPengurus Perumahan Bumi Agung";

                $fonnte->sendMessage($invoice->user->no_wa, $pesan);
            }
        }

        return response()->json(['message' => 'Webhook berhasil diproses'], 200);
    }
}
