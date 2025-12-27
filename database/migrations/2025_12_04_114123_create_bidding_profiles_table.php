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
        Schema::create('bidding_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bidding_platform_id')->constrained('bidding_platforms')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->string('profile_name', 100)->nullable();
            $table->string('profile_url', 255)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('username', 50)->nullable();
            $table->string('password_note', 255)->nullable();
            $table->string('category', 100)->nullable();
            $table->text('skills')->nullable();
            $table->string('success_score', 20)->nullable();
            $table->decimal('rating', 3, 2)->nullable();
            $table->integer('connects_or_tokens')->default(0);
            $table->text('notes')->nullable();
            $table->string('status', 20)->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidding_profiles');
    }
};
