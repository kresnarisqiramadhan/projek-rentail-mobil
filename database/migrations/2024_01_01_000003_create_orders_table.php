<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code', 20)->unique();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('vehicle_id')->constrained('vehicles')->restrictOnDelete();
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_price', 12, 2);
            $table->enum('status', [
                'PENDING',
                'PENDING_VERIFICATION',
                'PAID',
                'ACTIVE',
                'COMPLETED',
                'RATED',
                'CANCELLED',
                'REFUND_REQUESTED',
                'REFUNDED',
            ])->default('PENDING');
            $table->enum('payment_method', ['gateway', 'manual']);
            $table->timestamp('payment_timeout_at');
            $table->string('payment_proof', 500)->nullable();
            $table->string('refund_bank_name', 100)->nullable();
            $table->string('refund_account_name')->nullable();
            $table->string('refund_account_number', 50)->nullable();
            $table->timestamps();

            // Critical indexes per SAD section 3.2
            $table->index(['user_id', 'status'], 'orders_user_status_index');
            $table->index(['vehicle_id', 'start_date', 'end_date'], 'orders_vehicle_dates_index');
            $table->index(['payment_timeout_at', 'status'], 'orders_timeout_status_index');
            $table->index('status');
            $table->index('vehicle_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
