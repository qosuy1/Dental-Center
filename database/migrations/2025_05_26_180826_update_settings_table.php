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
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->string('email')->nullable()->change();


            $table->string('linkedin')->nullable()->after('address');
            $table->string('instagram')->nullable()->after('address');
            $table->string('facebook')->after('address');
            $table->string('number')->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('title');
            $table->string('email')->nullable(false)->change();
            $table->dropColumn('number');
            $table->dropColumn('facebook');
            $table->dropColumn('linkedin');
            $table->dropColumn('instagram');

        });
    }
};
