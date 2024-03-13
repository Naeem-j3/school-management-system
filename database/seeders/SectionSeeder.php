<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Section;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Factory::create();

        // Loop to create sections
        for ($i = 0; $i < 5; $i++) {
            $grade_id=$faker->numberBetween(1, 3);
            $classroom_id = Classroom::where('grade_id', $grade_id)->inRandomOrder()->first()->id;
            Section::create([
                'section_name' => $faker->randomLetter, // Generate random letter for section name
                'status' => 1, // Generate random boolean value for status
                'grade_id' => $grade_id, // Generate random grade ID between 1 and 2
                'classroom_id' => $classroom_id // Generate random classroom ID between 1 and 4
            ]);
        }

        }
}
