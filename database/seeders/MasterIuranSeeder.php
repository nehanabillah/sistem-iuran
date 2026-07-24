<?php

namespace Database\Seeders;

use App\Models\MasterIuran;
use Illuminate\Database\Seeder;

class MasterIuranSeeder extends Seeder
{
    public function run(): void
    {
        MasterIuran::create([
            'nama_iuran' => 'Iuran Keamanan',
            'nominal' => 21000,
            'is_active' => true,
        ]);

        MasterIuran::create([
            'nama_iuran' => 'Kas Bulanan',
            'nominal' => 4000,
            'is_active' => true,
        ]);
    }
}
