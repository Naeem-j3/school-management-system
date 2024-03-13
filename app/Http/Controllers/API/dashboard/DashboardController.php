<?php

namespace App\Http\Controllers\API\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Library;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard(){
        $data['student_number']=Student::count();
        $data['teacher_number']=Teacher::count();
        $data['section_number']=Section::count();
        $data['book_number']=Library::count();
        return response()->json(['data'=>$data]);
    }
    public function teacherDashboard(){
        $ids = Teacher::find(auth()->user()->id)->sectionTeachers()->pluck('section_id');
        $data['count_sections']= $ids->count();
        $data['count_students']= \App\Models\Student::whereIn('section_id',$ids)->count();
        return response()->json(['data'=>$data]);
    }

}
