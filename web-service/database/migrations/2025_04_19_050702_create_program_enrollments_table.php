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
        Schema::create('program_enrollments', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default(0); // 0 = on going, 1 = completed, 2 = canceled, 3 = changed
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('diet_program_id')->constrained('diet_programs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_enrollments');
    }
};
