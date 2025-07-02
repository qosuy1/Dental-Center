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
        // Rename table
        Schema::rename('sub_services', 'services');

        // Modify table structure
        Schema::table('services', function (Blueprint $table) {
            $table->renameColumn('title', 'name');
            $table->string('smallDesc')->nullable()->change();
            $table->dropColumn('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse the changes
        Schema::rename('services', 'sub_services');

        Schema::table('sub_services', function (Blueprint $table) {
            $table->renameColumn('name', 'title');
            $table->string('smallDesc')->nullable(false)->change();
            $table->string('image');
        });
    }
};
