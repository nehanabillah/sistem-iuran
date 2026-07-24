<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Mengubah struktur ENUM pada kolom status agar mendukung nilai 'pending'
        DB::statement("ALTER TABLE invoices MODIFY COLUMN status ENUM('unpaid', 'pending', 'paid') NOT NULL DEFAULT 'unpaid'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Mengembalikan struktur ENUM ke setelan awal jika dilakukan rollback
        DB::statement("ALTER TABLE invoices MODIFY COLUMN status ENUM('unpaid', 'paid') NOT NULL DEFAULT 'unpaid'");
    }
};
