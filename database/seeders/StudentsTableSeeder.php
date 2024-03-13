<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Student;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        foreach (range(1, 50) as $index) {
            $grade_id=$faker->numberBetween(1, 3);
            $classroom = Classroom::where('grade_id', $grade_id)->inRandomOrder()->first()->id;
            Student::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'), // You may want to change this to a secure password hashing method
                'gender' => $faker->randomElement(['m', 'f']),
                'birth_date' => $faker->date,
                'nationality_id' => $faker->numberBetween(1, 10), // Adjust based on your nationality data
                'blood_id' => $faker->numberBetween(1, 5), // Adjust based on your blood data
                'religion_id' => $faker->numberBetween(1, 3), // Adjust based on your religion data
                'grade_id' => $grade_id, // Adjust based on your grade data
                'class_id' => $classroom, // Adjust based on your classroom data
                'section_id' => $faker->numberBetween(1, 4), // Adjust based on your section data
                'parent_id' => $faker->numberBetween(1, 10), // Adjust based on your parent data
                'academic_year' => $faker->year,
            ]);
        }
    }
}
