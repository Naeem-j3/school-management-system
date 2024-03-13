<?php

namespace App\Http\Controllers\API\Classroom;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter= $request->input("filter");
        $classroom=new Classroom();
        if (isset($filter)) {
          $classroom = Classroom::where("grade_id",$filter)->with(['grade:id,name'])->get();

        }else{
        $classroom = Classroom::with(['grade:id,name'])->get();
        }
        return response()->json(['data'=>$classroom]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'list' => ['required', 'array'],
            'list.*.name' => ['required'],
            'list.*.grade_id' => ['required'],
        ]);

        $data = [];
        foreach ($request->list as $classroom) {
            $class = Classroom::create([
                'name' => $classroom['name'],
                'grade_id' => $classroom['grade_id'],
            ]);
            $data[] = Classroom::with('grade:id,name')->find($class['id']);
        }
        return response()->json([
            'data' => $data,
            'message' => 'classroom created successfuly'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // dd($classroom);
        $classroom = Classroom::with('grade:id,name')->findOrFail($id);
        return response()->json(['data' => $classroom]);

        return response()->json(['message' => 'classroom not exist']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $classroom = Classroom::findOrFail($id);
        if ($request->has('name', 'grade_id')) {
            $classroom->update([
                "name" => ($request['name']) ? $request['name'] : $classroom['name'],
                "grade_id" => ($request["grade_id"]) ? $request["grade_id"] : $classroom["grade_id"],
            ]);
            return response()->json(['data' => $classroom, "message" => "classroom updated successfuly"]);
        }
        return response()->json(["message" => "should to send name and grade togather"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Classroom::find($id)->delete();
        return response()->json(['message' => 'classroom deleted successfully']);
    }
      /**
     * delete selected grades (check box)
     */
    public function delete_selected_id(Request $request){
        $selected_id=explode(",",$request->selected_id);
        Classroom::query()->whereIn("id",$selected_id)->delete();
        return response()->json(["message"=> "the emelents are deleted successfuly"]);

    }
}
