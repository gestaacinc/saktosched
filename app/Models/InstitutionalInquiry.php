<?php

namespace App\Models;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('institutional_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('organization_name');
            $table->string('representative_name');
            $table->string('email');
            $table->string('phone');
            $table->foreignId('qualification_id')->constrained();
            $table->integer('num_applicants');
            $table->string('status')->default('pending'); // e.g., pending, verified, proposal_sent, confirmed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('institutional_inquiries');
    }
};