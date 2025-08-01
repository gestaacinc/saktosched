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
        Schema::table('bookings', function (Blueprint $table) {
            // Add new columns to store the contact info of the person making the booking
            $table->string('booker_name')->after('user_id');
            $table->string('booker_email')->after('booker_name');
            $table->string('booker_phone')->after('booker_email');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['booker_name', 'booker_email', 'booker_phone']);
        });
    }
};
