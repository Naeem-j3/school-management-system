<?php

namespace App\Http\Controllers\API\quiz;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class QuestionController extends Controller
{

    public function index()
    {
        $questions = Question::with('quiz')->get();
        if(isEmpty($questions)){
            return response()->json(['questions'=>$questions,'message'=>'there is no questions yet'] );
        }
        return response()->json(['question'=>$questions],200);
    }



    public function store(Request $request)
    {
        try {

            $question =Question::create([
                'title'=>$request['title'],
                'answers'=>$request['answers'],
                'right_answer'=>$request['right_answer'],
                'score'=>$request['score'],
                'quizze_id'=>$request['quizze_id'],
            ]);
            $questions=Question::where('id',$question->id)->with('quiz')->get();
            return response()->json(['question'=>$questions,'message'=>'question created successfully'],200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()],400);
        }
    }


    public function update(Request $request,$id)
    {
        try {
            $question=Question::find($id);
            $question->update([
                'title'=>$request['title'],
                'answers'=>$request['answers'],
                'right_answer'=>$request['right_answer'],
                'score'=>$request['score'],
                'quizze_id'=>$request['quizze_id'],
            ]);
            $questions=$question->with('quiz')->get();
            return response()->json(['question'=>$questions,'message'=>'question updated successfully'],200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()],400);
        }
    }

    public function destroy($id)
    {
        $question = Question::find($id);
        if (!$question) {
            return response()->json(['message' => 'question not found'], 404);
        }
        $question->delete();
        return response()->json(['message' => 'question deleted successfully'], 200);

    }
}
