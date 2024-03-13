<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Classroom::create([
            'name'=>'first',
            'grade_id'=>1
        ]);
        Classroom::create([
            'name'=>'second',
            'grade_id'=>1
        ]);
        Classroom::create([
            'name'=>'third',
            'grade_id'=>1
        ]);
        Classroom::create([
            'name'=>'seventh',
            'grade_id'=>2
        ]);
        Classroom::create([
            'name'=>'tenth',
            'grade_id'=>3
        ]);
    }
}
