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
        Schema::create('consultation_schedules', function (Blueprint $table) {
            $table->id();
            $table->timestamp('schedule_date')->nullable();
            $table->tinyInteger('status')->default(0); // 0 = pending, 1 = completed, 2 = canceled
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('program_enrollment_id')->constrained('program_enrollments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_schedules');
    }
};
