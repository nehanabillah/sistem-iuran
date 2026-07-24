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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('invoice_number')->unique();
            $table->string('bulan_tagihan', 7); // Format: YYYY-MM (contoh: 2026-05)
            $table->integer('total_tagihan');
            $table->enum('status', ['unpaid', 'paid'])->default('unpaid');

            // Pelacakan Pembayaran
            $table->string('payment_method')->nullable(); // 'midtrans' atau 'manual'
            $table->foreignId('paid_by')->nullable()->constrained('users'); // ID Pengurus jika bayar manual
            $table->dateTime('paid_at')->nullable();
            $table->string('snap_token')->nullable(); // Untuk Midtrans

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
