<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$clientKey = config('services.midtrans.client_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function getSnapToken($invoice)
    {
        $params = [
            'transaction_details' => [
                'order_id' => $invoice->invoice_number,
                'gross_amount' => $invoice->total_tagihan,
            ],
            'customer_details' => [
                'first_name' => $invoice->user->name,
                'email' => $invoice->user->email,
                'phone' => $invoice->user->no_wa,
            ],
        ];

        return Snap::getSnapToken($params);
    }
}
