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
        Schema::table('testimonials', function (Blueprint $table) {
            $table->text('quote')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_title')->nullable();
            $table->string('company')->nullable();
            $table->string('photo_url', 500)->nullable();
            $table->boolean('is_featured')->default(false);
            
            $table->index('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['quote', 'customer_name', 'customer_title', 'company', 'photo_url', 'is_featured']);
            $table->dropIndex(['testimonials_is_featured_index']);
        });
    }
};
