<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Tentukan jadwal perintah aplikasi.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Sistem akan men-generate tagihan baru setiap tanggal 20, tepat pada jam 00:00 tengah malam
        $schedule->command('invoices:generate')
                 ->monthlyOn(20, '00:00')
                 ->timezone('Asia/Jakarta') // Pastikan zona waktu sesuai
                 ->appendOutputTo(storage_path('logs/billing.log')); // Catat riwayatnya di log

        // Tips Testing:
        // Jika kamu ingin mengetesnya berjalan sekarang juga,
        // kamu bisa mengaktifkan baris di bawah ini untuk sementara:
        // $schedule->command('invoices:generate')->everyMinute();
    }

    /**
     * Daftarkan perintah artisan untuk aplikasi.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
