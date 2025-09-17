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
        Schema::table('course_assignments', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['assigned_by']);
            
            // Change assigned_by to a simple integer without foreign key constraint
            // This allows it to reference either users or admins table
            $table->unsignedBigInteger('assigned_by')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_assignments', function (Blueprint $table) {
            // Restore the foreign key constraint
            $table->foreign('assigned_by')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
