<?php

namespace Database\Seeders;

use App\Models\Blood;
use App\Models\Nationalitie;
use App\Models\Religion;
use App\Models\TheParent;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TheParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $faker=Factory::create();
    for($i=0;$i<10;$i++){
    $nationalitieId = Nationalitie::inRandomOrder()->first()->id;
    $bloodId = Blood::inRandomOrder()->first()->id;
    $religionId = Religion::inRandomOrder()->first()->id;

        TheParent::create([
                'father_name' => $faker->name('male'),
                'father-national_id' => $faker->randomNumber(8),
                'father_passport_id' => $faker->randomNumber(9),
                'father_phone' => $faker->phoneNumber,
                'father_job' => $faker->jobTitle,
                'father_nationalitie_id' => $nationalitieId,
                'father_blood_id' => $bloodId,
                'father_religion_id' => $religionId,

                'mother_name' => $faker->name('female'),
                'mother-national_id' => $faker->randomNumber(8),
                'mother_passport_id' => $faker->randomNumber(9),
                'mother_phone' => $faker->phoneNumber,
                'mother_job' => $faker->jobTitle,
                'mother_nationalitie_id' => $nationalitieId,
                'mother_blood_id' => $bloodId,
                'mother_religion_id' => $religionId,

        ]);
    }

    }
}
