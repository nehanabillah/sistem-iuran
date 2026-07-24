<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    /**
     * Mengirim pesan WhatsApp via Fonnte API
     *
     * @param string $target Nomor WA tujuan (contoh: 08123456789 atau 628123456789)
     * @param string $message Isi pesan
     * @return array|bool
     */
    public function sendMessage($target, $message)
    {
        // Mengambil token dari file .env
        $token = env('FONNTE_TOKEN');

        // Jika token kosong (misal saat testing lokal tanpa internet), gagalkan dengan aman
        if (!$token) {
            Log::warning('Fonnte Token tidak ditemukan di .env. Pesan batal dikirim.');
            return false;
        }

        try {
            // Hit API Fonnte
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->post('https://api.fonnte.com/send', [
                'target' => $target,
                'message' => $message,
                'countryCode' => '62', // Memaksa format Indonesia jika nomor diawali 0
            ]);

            return $response->json();
        } catch (\Exception $e) {
            // Catat error di storage/logs/laravel.log jika gagal
            Log::error('Gagal mengirim WA via Fonnte: ' . $e->getMessage());
            return false;
        }
    }
}
