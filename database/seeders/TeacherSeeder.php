<?php

namespace Database\Seeders;

use App\Models\Specialization;
use App\Models\Teacher;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teacher::query()->delete();
         // Use Faker to generate fake data
        $faker = Factory::create();

         $specializationIds = Specialization::pluck('id')->toArray();
         $numberOfTeachers = 10;
         for ($i = 0; $i < $numberOfTeachers; $i++) {
             $teacher = new Teacher();
             $teacher->email = $faker->unique()->safeEmail;
             $teacher->password = Hash::make('password');
             $teacher->name = $faker->name;
             $teacher->specialization_id = $faker->randomElement($specializationIds);
             $teacher->gender = $faker->randomElement(['m', 'f']);
             $teacher->joining_date = $faker->date();
             $teacher->address = $faker->address;
             $teacher->save();

     }
    }
}
