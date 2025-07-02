<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->text('google_map_location')->after('linkedin')->nullable();
            $table->text('our_story')->after('linkedin');
            $table->string('about_us_image')->after('linkedin')->nullable();


            // $table->text('google_map_location')->nullable();
            // $table->text('our_story')->nullable();
            // $table->string('about_us_image')->nullable();

        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('google_map_location');
            $table->dropColumn('our_story');
            $table->dropColumn('about_us_image');
        });
    }
};
