<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('platform')->nullable();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->decimal('bid_amount',10,2)->nullable();
            $table->string('status')->default('pending');
            $table->date('deadline')->nullable();
            $table->string('proposal_url')->nullable();
            $table->longText('notes')->nullable();
            $table->integer('connections_used')->nullable();
            $table->integer('connections_left')->nullable();
            $table->string('project_link')->nullable();
            $table->string('technology')->nullable();
            $table->integer('outbid_count')->default(0);
            $table->decimal('project_budget',10,2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};
