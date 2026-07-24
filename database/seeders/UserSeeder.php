<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // PENTING: Bersihkan tabel terlebih dahulu agar tidak ada error duplikat
        // Karena ada relasi foreign key, kita harus mematikan check-nya sementara
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Default password
        $password = Hash::make('password123');

        // ---------------------------------------------------
        // 1. Akun Pengurus Inti
        // ---------------------------------------------------
        User::create([
            'name' => 'Joko Purnomo',
            'email' => 'rw@bumiagung.com',
            'password' => $password,
            'role' => 'rw',
            'rt' => 0,
            'no_rumah' => 'RW-01',
            'no_wa' => '08',
            'status' => 'aktif',
        ]);

        User::create([
            'name' => 'Novi Harianto',
            'email' => 'bendahara@bumiagung.com',
            'password' => $password,
            'role' => 'bendahara',
            'rt' => 0,
            'no_rumah' => 'BEND-01',
            'no_wa' => '08',
            'status' => 'aktif',
        ]);

        // ---------------------------------------------------
        // 2. Akun 4 Ketua RT (Manual)
        // ---------------------------------------------------
        User::create([
            'name' => 'Ketua RT 1',
            'email' => 'rt1@bumiagung.com',
            'password' => $password,
            'role' => 'rt',
            'rt' => 1,
            'no_rumah' => 'RT-01',
            'no_wa' => '08',
            'status' => 'aktif',
        ]);

        User::create([
            'name' => 'Ketua RT 02',
            'email' => 'rt2@bumiagung.com',
            'password' => $password,
            'role' => 'rt',
            'rt' => 2,
            'no_rumah' => 'RT-02',
            'no_wa' => '08',
            'status' => 'aktif',
        ]);

        User::create([
            'name' => 'Ketua RT 03',
            'email' => 'rt3@bumiagung.com',
            'password' => $password,
            'role' => 'rt',
            'rt' => 3,
            'no_rumah' => 'RT-03',
            'no_wa' => '08',
            'status' => 'aktif',
        ]);

        User::create([
            'name' => 'Ketua RT 04',
            'email' => 'rt4@bumiagung.com',
            'password' => $password,
            'role' => 'rt',
            'rt' => 4,
            'no_rumah' => 'RT-04',
            'no_wa' => '08',
            'status' => 'aktif',
        ]);

        // Warga RT 1
        User::create([
            'name' => 'Anggoro Adityo',
            'email' => 'warga1@bumiagung.com',
            'password' => $password,
            'role' => 'warga',
            'rt' => 1,
            'no_rumah' => 'A1-01',
            'no_wa' => '081266398611',
            'status' => 'aktif'
        ]);

        // ---------------------------------------------------
        // 4. Akun Pendaftar Baru (Status Pending di RT 1)
        // ---------------------------------------------------
        User::create([
            'name' => 'Onny Budi ',
            'email' => 'warga2@bumiagung.com',
            'password' => $password,
            'role' => 'warga',
            'rt' => 1,
            'no_rumah' => 'A1-03',
            'no_wa' => '081266398611',
            'status' => 'pending', // Butuh approval RT
        ]);
    }
}
