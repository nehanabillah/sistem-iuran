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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // Tambahan custom kolom untuk sistem kita
            $table->string('no_rumah')->nullable();
            $table->string('rt', 5)->nullable();
            $table->string('no_wa', 20)->nullable();
            $table->enum('role', ['warga', 'rt', 'rw', 'bendahara'])->default('warga');
            $table->enum('status', ['pending', 'aktif', 'nonaktif'])->default('pending');

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
