<?php

use App\Models\Department;
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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('experince');
            $table->string('phone');
            $table->string('email');
            $table->string('linkedin')->nullable();
            $table->string('facebook')->nullable();
            $table->string('image')->nullable();
            $table->string('cloudinary_public_id')->nullable();
            $table->foreignIdFor(Department::class);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
