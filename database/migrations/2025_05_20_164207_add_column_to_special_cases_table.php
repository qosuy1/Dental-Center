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
            $table->string('title')->after('id')->default('defualt title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('special_cases', function (Blueprint $table) {
            $table->dropColumn('title');
        });
    }
};
