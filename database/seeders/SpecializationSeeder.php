<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Specialization::query()->delete();

        $specialization=['maths','sport','physics','chemistry','science'];

        foreach ($specialization as $sp){
            Specialization::create(['name'=>$sp]);
        }
    }
}
