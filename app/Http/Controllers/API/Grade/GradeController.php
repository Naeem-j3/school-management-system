<?php

namespace App\Http\Controllers\API\Grade;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;
use PhpParser\Builder\Class_;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::query()->select('id','name','note')->get();
        return response()->json(['data'=>$grades,'message'=>"get success"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=> ['required','unique:grades,name'],
        ]);
        $grade = Grade::create([
            "name"=>$request['name'],
            "note"=>$request['note']
    ]);
        return response()->json(["data"=>$grade,"message"=> "grade created successfuly"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $grade = Grade::find($id)->first();

        if(!is_null($grade)){
        return response()->json(["data"=>$grade]);
        }
        return response()->json(["message"=> "grade not exist"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name"=> ['unique:grades,name'],
        ]);
        $grade= Grade::find($id)->first();

        $grade->update([
            "name"=>($request['name'])?$request['name']:$grade['name'],
            "note"=>($request["note"])?$request["note"]:$grade["note"],
        ]);
        return response()->json(["data"=>$grade,'message'=>"grade updated successfuly"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $classes= Classroom::where('grade_id',$id)->pluck('grade_id');
        if($classes->count()== 0){
        Grade::where('id',$id)->delete();
        return response()->json(["message"=> "grade deleted successfuly"]);
        }
        else{
            return response()->json(["message"=> "this grade have classrooms"]);
         }
    }
  
}
