<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id')->nullable(true)->default(null)->change();
            $table->string('doctor_name')
                ->nullable(false)
                ->default('city smile')
                ->after('doctor_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id')->nullable(true)->default('1');
            $table->dropColumn('doctor_name');
        });
    }
};
