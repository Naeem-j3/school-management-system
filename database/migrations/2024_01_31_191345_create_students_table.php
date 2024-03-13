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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('gender', ['m', 'f']);
            $table->date('birth_date');
            $table->foreignId('nationality_id')->constrained('nationalities','id');
            $table->foreignId('blood_id')->constrained('bloods','id');
            $table->foreignId('religion_id')->constrained('religions','id');
            $table->foreignId('grade_id')->constrained('grades','id');
            $table->foreignId('class_id')->constrained('classrooms','id');
            $table->foreignId('section_id')->constrained('sections','id');
            $table->foreignId('parent_id')->constrained('the_parents','id');
            $table->string('academic_year');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
