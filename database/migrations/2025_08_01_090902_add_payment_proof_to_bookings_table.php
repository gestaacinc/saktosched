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
            // Change the payment_status column to have more detailed states
            $table->string('payment_status')->default('pending_payment')->change();
            
            // Add a column to store the path to the uploaded payment proof image
            $table->string('payment_proof_path')->nullable()->after('payment_status');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('payment_status')->default('reservation_paid')->change();
            $table->dropColumn('payment_proof_path');
        });
    }
};
