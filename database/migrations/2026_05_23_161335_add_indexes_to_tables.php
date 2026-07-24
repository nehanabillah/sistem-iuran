<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Menambahkan index pada tabel users untuk mempercepat query pencarian berdasarkan RT & Status
        Schema::table('users', function (Blueprint $table) {
            $table->index(['rt', 'status']);
        });

        // Menambahkan index pada tabel invoices untuk mempercepat pencarian tagihan, nomor invoice, dan bulan
        Schema::table('invoices', function (Blueprint $table) {
            $table->index(['user_id', 'status']);
            $table->index('invoice_number');
            $table->index('bulan_tagihan');
        });

        // Menambahkan index pada tabel kas_keluars berdasarkan tanggal transaksi
        Schema::table('kas_keluars', function (Blueprint $table) {
            $table->index('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['rt', 'status']);
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'status']);
            $table->dropIndex('invoice_number');
            $table->dropIndex('bulan_tagihan');
        });

        Schema::table('kas_keluars', function (Blueprint $table) {
            $table->dropIndex('tanggal');
        });
    }
};
