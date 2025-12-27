<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('client_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->string('invoice_number')->unique();
            $table->string('client_email')->nullable();
            $table->date('invoice_date');
            $table->date('due_date')->nullable();
            $table->decimal('amount',10,2);
            $table->decimal('tax',10,2)->default(0);
            $table->decimal('discount',10,2)->default(0);
            $table->string('payment_status')->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('attachment')->nullable();
            $table->decimal('profit',10,2)->nullable();
            $table->decimal('loss',10,2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_invoices');
    }
};
