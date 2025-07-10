<?php

use App\Models\Doctor;
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
        Schema::create('special_cases', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Doctor::class);

            $table->tinyInteger('patient_age');
            $table->string('treatment_duration');
            $table->string('procedures');
            $table->string('overview');
            $table->text('treatment_plan');
            $table->string('result');
            $table->string('feedback')->nullable();
            $table->string('before_image');
            $table->string('cloudinary_public_id_before')->nullable();
            $table->string('after_image');
            $table->string('cloudinary_public_id_after')->nullable();
            $table->boolean('is_specail_case');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_cases');
    }
};
