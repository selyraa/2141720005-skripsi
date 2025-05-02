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
        Schema::create('checkups', function (Blueprint $table) {
            $table->id();
            $table->timestamp('checkup_date')->nullable();
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->float('body_fat');
            $table->float('belly_fat');
            $table->float('bone_density');
            $table->float('calories_needs');
            $table->integer('cell_age');
            $table->float('muscle_mass');
            $table->float('water_content');
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('program_enrollment_id')->nullable()->constrained('program_enrollments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkups');
    }
};
