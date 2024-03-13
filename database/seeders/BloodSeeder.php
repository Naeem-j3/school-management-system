<?php

namespace Database\Seeders;

use App\Models\Blood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blood::query()->delete();
        $blood=['A+','A-','B+','B-','O+','O-','AB+','AB-'];
        foreach($blood as $b){
            Blood::query()->create(['name'=>$b]);
        }
    }
}
