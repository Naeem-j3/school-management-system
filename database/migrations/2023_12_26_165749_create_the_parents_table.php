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
        Schema::create('the_parents', function (Blueprint $table) {
            $table->id();
         //Fatherinformation
         $table->string('father_name');
         $table->string('father-national_id');
         $table->string('father_passport_id');
         $table->string('father_phone');
         $table->string('father_job');
         $table->foreignId('father_nationalitie_id')->constrained('nationalities','id');
         $table->foreignId('father_blood_id')->constrained('bloods','id');
         $table->foreignId('father_religion_id')->constrained('religions','id');
        

         //Mother information
         $table->string('mother_name');
         $table->string('mother-national_id');
         $table->string('mother_passport_id');
         $table->string('mother_phone');
         $table->string('mother_job');
         $table->foreignId('mother_nationalitie_id')->constrained('nationalities','id');
         $table->foreignId('mother_blood_id')->constrained('bloods','id');
         $table->foreignId('mother_religion_id')->constrained('religions','id');

         $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('the_parents');
    }
};
