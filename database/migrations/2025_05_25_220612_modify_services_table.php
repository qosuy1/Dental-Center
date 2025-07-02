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
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['department_id']);

            // $table->foreign('department_id')
            //     ->references('id')->on('departments')
            //     ->onDelete('cascade');
            $table->foreignIdFor(Department::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {

            $table->dropForeign(['department_id']);

            $table->foreign('department_id')
                ->references('id')->on('departments')
                ->onDelete('restrict');
        });
    }
};
