<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Immutable audit log — no updated_at, no soft deletes
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->restrictOnDelete();
            $table->decimal('amount', 12, 2);
            $table->enum('type', ['PAYMENT', 'REFUND', 'PARTIAL_REFUND']);
            $table->enum('status', ['SUCCESS', 'FAILED', 'PENDING']);
            $table->enum('method', ['gateway', 'manual']);
            $table->string('gateway_ref')->nullable();
            $table->enum('actor', ['CUSTOMER', 'ADMIN', 'SYSTEM', 'GATEWAY']);
            $table->text('notes')->nullable();
            $table->timestamp('created_at')->useCurrent(); // immutable — no updated_at

            $table->index('order_id');
            $table->index(['type', 'status'], 'transactions_type_status_index');
            $table->index('actor');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
