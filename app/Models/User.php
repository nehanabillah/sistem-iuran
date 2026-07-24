<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'rt',
        'no_rumah',
        'no_wa',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relasi: Satu user punya banyak tagihan
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    // Relasi: Bendahara yang input kas keluar
    public function kasKeluars()
    {
        return $this->hasMany(KasKeluar::class);
    }
}
