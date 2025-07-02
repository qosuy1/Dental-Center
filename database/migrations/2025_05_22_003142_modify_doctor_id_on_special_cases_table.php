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
        Schema::table('special_cases', function (Blueprint $table) {
            // Step 1: Drop the existing foreign key constraint
            $table->dropColumn(['doctor_id']);

            // Step 2: Make doctor_id nullable
            $table->unsignedBigInteger('doctor_id')->nullable();

            // Step 3: Add the new constraint
            $table->foreign('doctor_id')
                ->references('id')
                ->on('doctors')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('special_cases', function (Blueprint $table) {
            $table->dropForeign(['doctor_id']);
            $table->unsignedBigInteger('doctor_id')->nullable(false)->change(); // optional
            $table->foreign('doctor_id')->references('id')->on('doctors')->cascadeOnDelete();
        });
    }
};
