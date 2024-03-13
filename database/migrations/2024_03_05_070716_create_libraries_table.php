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
        Schema::create('libraries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('file_name');
            $table->foreignId('grade_id')->constrained('grades','id')->cascadeOnDelete();
            $table->foreignId('class_id')->constrained('classrooms','id')->cascadeOnDelete();;
            $table->foreignId('section_id')->constrained('sections','id')->cascadeOnDelete();;
            $table->foreignId('teacher_id')->nullable()->constrained('teachers','id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libraries');
    }
};
