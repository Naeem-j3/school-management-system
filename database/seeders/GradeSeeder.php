<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Grade::create([
            'name' => 'Grade 1',
            'note' => '1 to 6',
        ]);

        Grade::create([
            'name' => 'Grade 2',
            'note' => '7 to 9',
        ]);

        Grade::create([
            'name' => 'Grade 3',
            'note' => '10 to 12',
        ]);
    }
}
