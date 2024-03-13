<?php
namespace App\Repository\student;

use App\Models\Pormotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;


class PormotionRepository implements PormotionRepositoryInterface{

    public function getPromotion(){

        $promotions = Pormotion::with([
            'student:id,name',
            'fromGrade:id,name',
            'fromClassroom:id,name',
            'fromSection:id,section_name',
            'toGrade:id,name',
            'toClassroom:id,name',
            'toSection:id,section_name'
        ])->get();
        return response()->json(['promotion'=>$promotions]);
    }

    public function store($request)
    {

        DB::beginTransaction();

        try {

            $students = student::where('grade_id',$request['grade_id'])
            ->where('class_id',$request['class_id'])
            ->where('section_id',$request['section_id'])
            ->where('academic_year',$request['academic_year'])->get();

            if($students->count() < 1){
                 return response()->json(['message'=>'there is no students'],200);;
            }

            // update in table student
            foreach ($students as $student){

                $ids = explode(',',$student['id']);
                student::whereIn('id', $ids)
                    ->update([
                        'grade_id'=>$request['grade_id_new'],
                        'class_id'=>$request['classroom_id_new'],
                        'section_id'=>$request['section_id_new'],
                        'academic_year'=>$request['academic_year_new'],
                    ]);

                // insert in to promotions
                Pormotion::updateOrCreate([
                    'student_id'=>$student->id,
                    'from_grade'=>$request->grade_id,
                    'from_Classroom'=>$request->class_id,
                    'from_section'=>$request->section_id,
                    'to_grade'=>$request->grade_id_new,
                    'to_Classroom'=>$request->classroom_id_new,
                    'to_section'=>$request->section_id_new,
                    'academic_year'=>$request->academic_year,
                    'academic_year_new'=>$request->academic_year_new,
                ]);

            }
            DB::commit();

             return response()->json(['messag'=>'student updated successfully'], 200);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error'=>$e->getMessage()]);
        }

    }

    public function destroy($request)
    {
        DB::beginTransaction();

        try {

            // التراجع عن الكل
            if($request['page_id'] ==1){

             $Promotions = Pormotion::all();
             foreach ($Promotions as $Promotion){
                 //التحديث في جدول الطلاب
                 $ids = explode(',',$Promotion['student_id']);
                 student::whereIn('id', $ids)
                 ->update([
                    'grade_id'=>$Promotion['from_grade'],
                    'class_id'=>$Promotion['from_Classroom'],
                    'section_id'=> $Promotion['from_section'],
                    'academic_year'=>$Promotion['academic_year'],
               ]);

                 //حذف جدول الترقيات
                 Pormotion::truncate();

             }
                DB::commit();

                return response()->json(['message'=>'promotion deleted successfuly']);

            }

            else{

                $Promotion = Pormotion::findorfail($request['id']);
                student::where('id', $Promotion['student_id'])
                    ->update([
                        'grade_id'=>$Promotion['from_grade'],
                        'class_id'=>$Promotion['from_Classroom'],
                        'section_id'=> $Promotion['from_section'],
                        'academic_year'=>$Promotion['academic_year'],
                    ]);


                    Pormotion::destroy($request->id);
                DB::commit();

                return response()->json(['message'=>'promotion deleted successfuly']);


            }

        }

        catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error'=>$e->getMessage()]);
        }
    }

}
