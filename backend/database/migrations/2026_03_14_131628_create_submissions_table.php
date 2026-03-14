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
    Schema::create('submissions', function (Blueprint $table) {
        $table->id();
        // Role Context
        $table->string('role');
        $table->string('industry');
        $table->string('country');
        $table->string('experience_level');
        // Hiring Process
        $table->string('stage');
        $table->string('feedback');
        $table->text('notes')->nullable();
        // Salary & Benefits
        $table->string('salary_discussed');
        $table->string('currency')->nullable();
        $table->string('period')->nullable();
        $table->string('salary_type')->nullable();
        $table->decimal('amount', 10, 2)->nullable();
        // Job Description
        $table->text('job_description')->nullable();
        // Your Impression
        $table->text('overall_impression')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
