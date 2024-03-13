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
        Schema::create('pormotions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students','id');
            $table->foreignId('from_grade')->constrained('grades','id');
            $table->foreignId('from_Classroom')->constrained('classrooms','id');
            $table->foreignId('from_section')->constrained('sections','id');
            $table->foreignId('to_grade')->constrained('grades','id');
            $table->foreignId('to_Classroom')->constrained('classrooms','id');
            $table->foreignId('to_section')->constrained('sections','id');
            $table->string('academic_year')->constrained('',);
            $table->string('academic_year_new')->constrained('',);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pormotions');
    }
};
