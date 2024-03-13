<?php

namespace App\Repository\quizze;

use App\Models\Quizze;
use Exception;

use function PHPUnit\Framework\isEmpty;

class QuizzeRepository implements QuizzeRepositoryInterface
{

    public function index()
    {
        $quizzes = Quizze::with('subject','teacher','classroom','section')->get();
        if(isEmpty($quizzes)){
            return response()->json(['Quizzes'=>$quizzes,'message'=>'there is no Quizzes yet'] );
        }
        return response()->json(['Quizzes'=>$quizzes], 200 );
    }

    public function store($request)
    {
        try {
            $quiz= Quizze::create([
                'name'=>$request['name'],
                'subject_id'=>$request['subject_id'],
                'grade_id'=>$request['grade_id'],
                'class_id'=>$request['class_id'],
                'section_id'=>$request['section_id'],
                'teacher_id'=>$request['teacher_id']
            ]);
    $data['quiz']=$quiz->with('subject','teacher','classroom','section')->get();

            return response()->json(['quiz'=>$data['quiz'],'message'=>'there quiz created successfully'] );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update($request,$id)
    {
        try {
            $quiz = Quizze::find($id);
            $quiz->update([
                'name'=>$request['name'],
                'subject_id'=>$request['subject_id'],
                'grade_id'=>$request['grade_id'],
                'class_id'=>$request['class_id'],
                'section_id'=>$request['section_id'],
                'teacher_id'=>$request['teacher_id']
            ]);;
            $data['quiz']=$quiz->with('subject','teacher','classroom','section')->get();

            return response()->json(['Quiz'=>$data['quiz'],'message'=>'there Quiz updated successfully'] );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $Quiz = Quizze::find($id);
        if (!$Quiz) {
            return response()->json(['message' => 'Quiz not found'], 404);
        }
        $Quiz->delete();
        return response()->json(['message' => 'Quiz deleted successfully'], 200);
    }

}
