<?php


namespace App\Repository\student;


use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\JsonResponse;

class StudentGraduatedRepository implements StudentGraduatedRepositoryInterface
{

    public function index()
    {
        $students = Student::onlyTrashed()->get();
        return response()->json(['students'=>$students]);
    }


    public function SoftDelete($request)
    {
        $students = student::where('grade_id',$request->grade_id)
        ->where('class_id',$request->class_id)
        ->where('section_id',$request->section_id)->get();

        if($students->count() < 1){
            return response()->json(['message'=>"there is no student"],400);
        }

        foreach ($students as $student){

            student::where('id', $student['id'])->Delete();
        }

     return response()->json(['message'=>"student graduated successfuly"],200);
    }

    public function ReturnData($request)
    {
        student::onlyTrashed()->where('id', $request->id)->first()->restore();
        return response()->json(['message'=>"student returned successfuly"],200);
    }

    public function destroy($request)
    {
        student::onlyTrashed()->where('id', $request->id)->first()->forceDelete();
        return response()->json(['message'=>"student deleted successfuly"],200);
    }


}
