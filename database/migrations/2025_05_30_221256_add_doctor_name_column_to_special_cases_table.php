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
        Schema::table('special_cases', function (Blueprint $table) {
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
        Schema::table('special_cases', function (Blueprint $table) {
            $table->dropColumn('doctor_name');
        });
    }
};
