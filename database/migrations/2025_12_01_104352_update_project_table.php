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
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('client_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('bid_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('project_manager')->nullable()->constrained('users')->nullOnDelete();
            $table->string('project_link')->nullable();
            $table->date('deadline')->nullable();
            $table->date('completed_at')->nullable();
            $table->string('technology')->nullable();
            $table->decimal('project_budget',10,2)->nullable();
            $table->decimal('final_cost',10,2)->nullable();
            $table->decimal('profit',10,2)->nullable();
            $table->decimal('loss',10,2)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            //
        });
    }
};
