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
        Schema::create('diet_recommendations', function (Blueprint $table) {
            $table->id();
            $table->text('recommendation')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('checkup_id')->constrained('checkups')->onDelete('cascade');
            $table->foreignId('llm_context_id')->constrained('llm_contexts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diet_recommendations');
    }
};
