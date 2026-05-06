<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('class');
            $table->decimal('price_per_day', 8, 2);
            $table->string('acceleration')->nullable();
            $table->integer('seats')->nullable();
            $table->integer('luggage')->nullable();
            $table->string('image_url')->nullable();
            $table->string('image_alt')->nullable();
            $table->boolean('electric')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
};
