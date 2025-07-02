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
            $table->renameColumn('is_specail_case', 'is_special_case');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('special_cases', function (Blueprint $table) {            //
            $table->renameColumn('is_special_case', 'is_specail_case');
        });
    }
};
