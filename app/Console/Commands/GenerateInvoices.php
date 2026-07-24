<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\BillingService;

class GenerateInvoices extends Command
{
    // Ini adalah nama perintah yang akan kita ketik di terminal nanti
    protected $signature = 'invoices:generate';

    protected $description = 'Men-generate tagihan iuran bulanan untuk seluruh warga aktif';

    public function handle(BillingService $billingService)
    {
        $this->info('Memulai proses pembuatan tagihan bulanan...');

        // Memanggil fungsi dari BillingService
        $jumlahTagihan = $billingService->generateMonthlyInvoices();

        if ($jumlahTagihan > 0) {
            $this->info("Berhasil! Sebanyak {$jumlahTagihan} tagihan baru telah dibuat.");
        } else {
            $this->info('Tidak ada tagihan baru yang dibuat. (Mungkin semua warga aktif sudah ditagih bulan ini).');
        }
    }
}
