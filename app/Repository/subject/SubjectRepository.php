<?php


namespace App\Repository\subject;


use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;

class SubjectRepository implements SubjectRepositoryInterface
{

    public function index()
    {
        $subjects = Subject::with('teacher:id,name,specialization_id','teacher.specilization:id,name','grade:id,name','classroom:id,name')->get();
       return response()->json(['subject'=>$subjects], 200,);
    }

    public function store($request)
    {
        try {
            $subjects = Subject::create([
                'name'=>$request['name'],
                'grade_id'=>$request['grade_id'],
                'class_id'=>$request['class_id'],
                'teacher_id'=>$request['teacher_id']
            ]);
            return response()->json(['subject'=>$subjects,'message'=>'subject created successfuly'], 200);

        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update($request,$id)
    {
        try {
            $subject =  Subject::find($id);
            $subject->update([
                'name'=>$request['name'],
                'grade_id'=>$request['grade_id'],
                'class_id'=>$request['class_id'],
                'teacher_id'=>$request['teacher_id']
            ]);
            return response()->json(['subject'=>$subject,'message'=>'subject updated successfuly'], 200);

        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()],400);
        }
    }

    public function destroy($id)
    {

        $subject = Subject::find($id);

        if (!$subject) {
            return response()->json(['message' => 'Subject not found'], 404);
        }

        $subject->delete();

        return response()->json(['message' => 'Subject deleted successfully'], 200);
    }
}
