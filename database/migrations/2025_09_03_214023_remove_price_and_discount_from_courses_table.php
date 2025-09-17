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
        Schema::table('courses', function (Blueprint $table) {
            // Remove price and discount columns as the system is now free
            $table->dropColumn(['price', 'discount']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            // Add back price and discount columns if needed
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
        });
    }
};
