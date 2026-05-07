<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->unique()->constrained('orders')->restrictOnDelete();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('vehicle_id')->constrained('vehicles')->restrictOnDelete();
            $table->unsignedTinyInteger('score'); // 1-5
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->index('vehicle_id');
            $table->index('user_id');
            $table->index('score');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
