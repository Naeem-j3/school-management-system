<?php


namespace App\Repository\student;


use App\Models\Fee;
use App\Models\Grade;

class FeeRepository implements FeeRepositoryInterface
{

    public function index(){

        $fees = Fee::with('grade:id,name','classroom:id,name')->get();
        return response()->json(['data'=>$fees]);

    }

    public function store($request)
    {
        try {

            $fees = Fee::create([
                'title' =>  $request['title'],
                'amount' => $request['amount'],
                'grade_id' => $request['grade_id'],
                'class_id' => $request['class_id'],
                'description' => $request['description'],
                'year' => $request['year'],
            ]);
            return response()->json(['fee'=>$fees,'message'=>'fee created successfuly'],200);

        }

        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        try {
            $fees = Fee::findorfail($request->id);
            $fees->update([
                    'title' =>  $request['title'],
                    'amount' => $request['amount'],
                    'grade_id' => $request['grade_id'],
                    'class_id' => $request['class_id'],
                    'description' => $request['description'],
                    'year' => $request['year'],
            ]);
            return response()->json(['fee'=>$fees,'message'=>'fee updated successfuly'],200);

        }

        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            Fee::destroy($request->id);
            return response()->json(['message' =>'fee deleted successfully']);
        }

        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
