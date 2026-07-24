<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterIuran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_iuran',
        'nominal',
        'is_active',
    ];
}
