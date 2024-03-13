<?php

namespace Database\Seeders;

use App\Models\Religion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Religion::query()->delete();
        $religions=['Muslim','Christian','Other'];
        foreach($religions as $n){
            Religion::create(['name'=>$n]);
        }
    }
}
