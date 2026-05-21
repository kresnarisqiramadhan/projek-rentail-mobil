<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah kolom payment_method menjadi string(50) agar bisa menerima 'bank' dan 'qris'
        Schema::table('orders', function (Blueprint $table) {
            // Hapus dulu default jika ada
            $table->string('payment_method', 50)->default('bank')->change();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Kembalikan ke enum semula jika diperlukan (hati-hati dengan data yang sudah ada)
            $table->enum('payment_method', ['gateway', 'manual'])->default('gateway')->change();
        });
    }
};
