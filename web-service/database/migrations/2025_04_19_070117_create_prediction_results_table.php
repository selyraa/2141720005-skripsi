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
        Schema::create('prediction_results', function (Blueprint $table) {
            $table->id();
            $table->float('confidence_score')->nullable();
            $table->boolean('is_selected')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('diet_prediction_id')->constrained('diet_predictions')->onDelete('cascade');
            $table->foreignId('diet_program_id')->constrained('diet_programs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prediction_results');
    }
};
