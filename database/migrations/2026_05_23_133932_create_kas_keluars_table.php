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
        Schema::create('kas_keluars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Bendahara yang input
            $table->integer('nominal');
            $table->text('keterangan');
            $table->date('tanggal');
            $table->string('bukti_kuitansi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kas_keluars');
    }
};
