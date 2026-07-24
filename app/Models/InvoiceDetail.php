<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'nama_iuran',
        'nominal',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
