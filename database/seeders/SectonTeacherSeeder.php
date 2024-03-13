<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\SectionTeacher;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectonTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = Teacher::all();
        $sections = Section::all();


        $sectionTeachersData = [];

        // Create relationships between teachers and sections
        foreach ($sections as $section) {
            $teacher = $teachers->random();
            $sectionTeachersData[] = [
                'teacher_id' => $teacher->id,
                'section_id' => $section->id,
            ];
        }

        // Insert data for each section_teacher into the section_teachers table
        foreach ($sectionTeachersData as $data) {
            SectionTeacher::create($data);
        }
    }
}
