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
        Schema::create('bidding_platforms', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('current_connection_balance')->default('0.00');
            $table->string('status')->default('active');
            $table->string('per_connection_cost')->default('0.00');
            $table->string('minimum_threshold_connection')->default('0.00');
            $table->string('conversion_rate')->default('0.00');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidding_platforms');
    }
};
