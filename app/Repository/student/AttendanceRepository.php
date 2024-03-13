<?php


namespace App\Repository\student;


use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;

class AttendanceRepository implements AttendanceRepositoryInterface
{



    public function show($id)
    {
        $students = Student::with('attendance')->where('section_id',$id)->get();
        return response()->json(['data'=>$students], 200);
    }

    public function store($request)
    {
        try {

            foreach ($request['attendences'] as  $attendence) {
                $attendence_status = true;
                if( $attendence['status'] == '1' ) {
                    $attendence_status = true;
                } else if( $attendence == '0' ){
                    $attendence_status = false;
                }

                Attendance::create([
                    'student_id'=> $attendence['student_id'],
                    'grade_id'=> $request['grade_id'],
                    'class_id'=> $request['class_id'],
                    'section_id'=> $request['section_id'],
                    'teacher_id'=> auth()->user()->id,
                    'attendence_date'=> now(),
                    'attendence_status'=> $attendence_status
                ]);

            }

            return response()->json(['message'=>'attendance regestred successfuly'], 200);

        }

        catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()],400);
        }
    }
    public function udpate($request)
    {

        try {
            $date = now();
            $attendance = Attendance::where('attendence_date', $date)->where('student_id', $request->id)->first();
            if ($request->attendences == '1') {
                $attendence_status = true;
            } else if ($request->attendences == '0') {
                $attendence_status = false;
            }
            $attendance->update([
                'attendence_status' => $attendence_status
            ]);
            return response()->json(['message'=>'attendance updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
