<?php

namespace App\Services;

use App\Models\User;
use App\Models\MasterIuran;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class BillingService
{
    protected $fonnte;

    public function __construct(FonnteService $fonnte)
    {
        $this->fonnte = $fonnte;
    }

    public function generateMonthlyInvoices()
    {
        $bulanTagihan = Carbon::now()->format('Y-m');

        // OPTIMASI 1: Cache data Master Iuran selama 60 menit agar tidak membebani database di dalam loop
        $masterIurans = Cache::remember('active_master_iurans', 3600, function () {
            return MasterIuran::where('is_active', true)->get();
        });

        $totalTagihan = $masterIurans->sum('nominal');
        $countCreated = 0;

        // OPTIMASI 2: Menggunakan chunk(100) agar server hemat RAM saat memproses ribuan warga
        User::where('role', 'warga')
            ->where('status', 'aktif')
            ->chunk(100, function ($wargaAktif) use ($bulanTagihan, $totalTagihan, $masterIurans, &$countCreated) {

                foreach ($wargaAktif as $warga) {
                    // Cek duplikasi tagihan
                    $invoiceExists = Invoice::where('user_id', $warga->id)
                                            ->where('bulan_tagihan', $bulanTagihan)
                                            ->exists();

                    if (!$invoiceExists) {
                        DB::transaction(function () use ($warga, $bulanTagihan, $totalTagihan, $masterIurans, &$countCreated) {

                            $invoice = Invoice::create([
                                'user_id' => $warga->id,
                                'invoice_number' => 'INV-' . Carbon::now()->format('ym') . '-' . str_pad($warga->id, 4, '0', STR_PAD_LEFT),
                                'bulan_tagihan' => $bulanTagihan,
                                'total_tagihan' => $totalTagihan,
                                'status' => 'unpaid',
                            ]);

                            foreach ($masterIurans as $iuran) {
                                InvoiceDetail::create([
                                    'invoice_id' => $invoice->id,
                                    'nama_iuran' => $iuran->nama_iuran,
                                    'nominal' => $iuran->nominal,
                                ]);
                            }

                            $countCreated++;

                            // Kirim WA
                            $pesan = "Halo Bpk/Ibu {$warga->name},\n\n";
                            $pesan .= "Tagihan Iuran Perumahan Bumi Agung bulan ini telah terbit:\n";
                            $pesan .= "No. Invoice: *{$invoice->invoice_number}*\n";
                            $pesan .= "Total: *Rp " . number_format($totalTagihan, 0, ',', '.') . "*\n\n";
                            $pesan .= "Silakan login ke aplikasi untuk melihat rincian dan melakukan pembayaran.\n\n";
                            $pesan .= "Terima kasih.";

                            $this->fonnte->sendMessage($warga->no_wa, $pesan);
                        });
                    }
                }
            });

        return $countCreated;
    }
}
