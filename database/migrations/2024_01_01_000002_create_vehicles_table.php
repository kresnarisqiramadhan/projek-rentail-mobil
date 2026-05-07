<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type', 100);
            $table->string('plate_number', 20)->unique();
            $table->decimal('price_per_day', 12, 2);
            $table->text('condition');
            $table->decimal('avg_rating', 3, 2)->default(0.00);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('type');
            $table->index('price_per_day');
            $table->index('is_active');
            $table->index(['is_active', 'type', 'price_per_day'], 'vehicles_filter_index');
        });

        Schema::create('vehicle_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles')->cascadeOnDelete();
            $table->string('path', 500);
            $table->boolean('is_360')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index('vehicle_id');
            $table->index(['vehicle_id', 'sort_order'], 'vehicle_photos_sort_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_photos');
        Schema::dropIfExists('vehicles');
    }
};
