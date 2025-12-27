<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bids', function (Blueprint $table) {
            $table->dropColumn('platform');

            $table->foreignId('bidding_profile_id')
                ->nullable()
                ->after('id')
                ->constrained('bidding_profiles')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('bids', function (Blueprint $table) {
            $table->string('platform')->nullable();

            $table->dropForeign(['bidding_profile_id']);
            $table->dropColumn('bidding_profile_id');
        });
    }
};
