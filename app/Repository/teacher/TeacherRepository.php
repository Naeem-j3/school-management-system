<?php
namespace App\Repository\teacher;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TeacherRepository implements TeacherRepositoryInterface{
    public function getAllTeachers()
    {
        $teacher=Teacher::with('specilization')->get();
        return response()->json(['teachers'=>$teacher,'message'=>'getting all teacher']) ;
    }

    public function storeTeachers( $request)
    {

        $request->validate([
            "email"=> ['required','unique:teachers,email'],
            "password"=>['required'],
            "name"=>['required'],
            "gender"=>['required'],
            "specialization_id"=>['required'],
            "joining_date"=>['required','date','date_format:Y-m-d'],
            "address"=>['required']
        ]);
        $request['password']=Hash::make($request['password']);
        $teacher=Teacher::create($request->all());
        return response()->json(['teacher'=>$teacher,'message'=>'new teacher created successfully']) ;
    }
    public function updateTeachers( $request,$id){
        $teacher = Teacher::findOrFail($id);
        $request->validate([
            "email" => [
                'required',
                Rule::unique('teachers')->ignore($teacher->id)->where(function ($query) use ($teacher) {
                    return $query->where('email', $teacher->email);
                }),
            ],
            "password" => ['required'],
            "name" => ['required'],
            "gender" => ['required'],
            "specialization_id" => ['required'],
            "joining_date" => ['required', 'date', 'date_format:Y-m-d'],
            "address" => ['required']
        ]);

        $request->merge(['password' => Hash::make($request->password)]);

        $teacher->update($request->all());

        return response()->json(['teacher' => $teacher, 'message' => 'Teacher updated successfully']);
    }

    public function deleteTeachers( $id){
        Teacher::findorfail($id)->delete();
        return response()->json([ 'message' => 'Teacher deleted successfully']);
    }
    public function getStudents(){
        $ids = Teacher::find(auth()->user()->id)->sectionTeachers()->pluck('section_id');
        $student= Student::whereIn('section_id',$ids)->get();
        return response()->json(['data'=>$student]);
    }
}
