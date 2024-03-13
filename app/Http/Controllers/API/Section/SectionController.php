<?php

namespace App\Http\Controllers\API\Section;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\SectionTeacher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $grades=Grade::with('sections')->get();
      $gradeList=Grade::all();

    return response()->json(['gradesWithSecetion'=>$grades,'gradeList'=>$gradeList,'message'=>'get success']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "section_name"=>["required"],
            "grade_id"=>["required"],
            "classroom_id"=>"required",
        ]);

     $section=Section::create([
        "section_name"=>$request["section_name"],
        "status"=>1,
        "grade_id"=>$request["grade_id"],
        "classroom_id"=>$request["classroom_id"],
     ]);
     if($request['teachers']){
        foreach($request['teachers'] as $teacher){
           SectionTeacher::create([
            'teacher_id'=>$teacher,
            'section_id'=>$section['id']
           ]);
        }
     }
     return response()->json([
        "data"=>$section,
        "message"=>"section created succssefully"
    ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {

            $section->update([
                "section_name" => ($request['section_name']) ? $request['section_name'] : $section['section_name'],
                "grade_id" => ($request["grade_id"]) ? $request["grade_id"] : $section["grade_id"],
                "classroom_id"=> ($request["classroom_id"]) ? $request["classroom_id"] : $section["classroom_id"],
                "status"=> ($request["status"]) ? $request["status"] : $section["status"]
            ]);

        if($request['teachers']){
            $section->sectionTeachers()->delete();
            foreach($request['teachers'] as $teacher){
                $section->sectionTeachers()->create([
                    'teacher_id'=>$teacher,
                    'section_id'=>$section['id']
                ]);
            }
        }
            return response()->json(['data' => $section, "message" => "classroom updated successfuly"]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        //
    }
    /**
     * get classes by grade id
     */
    public function getClassrooms($grade_id){
        $classList=Classroom::where('grade_id',$grade_id)->pluck('name','id');
        return response()->json([
            'data'=>$classList,
            'message'=>'get classrooms successfuly'
        ]);
    }
}
