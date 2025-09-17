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
        Schema::create('course_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('assigned_by')->constrained('users')->onDelete('cascade'); // Admin who assigned
            $table->enum('status', ['assigned', 'completed', 'in_progress'])->default('assigned');
            $table->timestamp('assigned_at')->useCurrent();
            $table->timestamp('completed_at')->nullable();
            $table->text('notes')->nullable(); // Optional notes from admin
            $table->timestamps();
            
            // Ensure unique assignment per user-course combination
            $table->unique(['user_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_assignments');
    }
};
