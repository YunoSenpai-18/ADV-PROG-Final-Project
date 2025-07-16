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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('applicant_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_id')->constrained('job_openings')->onDelete('cascade');
            $table->enum('status', ['Line up', 'On Process', 'For Interview', 'For Medical', 'Deployed'])->default('Line up');
            $table->enum('payment_status', ['Paid', 'Unpaid'])->default('Unpaid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
