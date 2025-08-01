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
        Schema::table('schedule_proposals', function (Blueprint $table) {
            // We make the user_id nullable because guests won't have one,
            // but logged-in users still can.
            $table->foreignId('user_id')->nullable()->change();

            // Add new columns to store guest information
            $table->string('proposer_name')->after('user_id');
            $table->string('proposer_email')->after('proposer_name');
            $table->string('proposer_phone')->after('proposer_email');
        });
    }

    public function down(): void
    {
        Schema::table('schedule_proposals', function (Blueprint $table) {
            // This reverses the changes if you ever need to roll back
            $table->foreignId('user_id')->nullable(false)->change();
            $table->dropColumn(['proposer_name', 'proposer_email', 'proposer_phone']);
        });
    }
};
