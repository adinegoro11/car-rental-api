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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('order_date')->nullable(false);
            $table->date('pickup_date')->nullable(false);
            $table->date('dropoff_date')->nullable(false);
            $table->string('pickup_location')->nullable(false);
            $table->string('dropoff_location')->nullable(false);
            $table->foreignId('car_id')->nullable(false)->constrained('cars')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
