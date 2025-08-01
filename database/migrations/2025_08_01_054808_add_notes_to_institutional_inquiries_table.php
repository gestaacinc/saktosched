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
        // Use Schema::table() to modify an existing table
        Schema::table('institutional_inquiries', function (Blueprint $table) {
            // Add the new column after the 'status' column
            $table->text('admin_notes')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('institutional_inquiries', function (Blueprint $table) {
            // This will correctly remove the column if you ever roll back
            $table->dropColumn('admin_notes');
        });
    }
};