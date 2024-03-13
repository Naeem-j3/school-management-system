<?php
namespace App\Repository\student;

use App\Models\Image;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentRepository implements StudentRepositoryInterface{
    public function getAllStudent(){
        $student = Student::with(
            [
            'blood:id,name', 'parent',
            'nationality:id,name',
            'images:id,file_name,imageable_id'
            ])->get();
        return response()->json(['data' => $student], 200);
    }

    public function showStudent($id)
    {
         // Fetch the student with all related information
         $student = Student::with([
            'nationality:id,name',
            'blood:id,name',
            'religion:id,name',
            'grade:id,name',
            'classroom:id,name',
            'section:id,section_name',
            'parent',
            'images'
        ])->findOrFail($id);

        // Return the student data as JSON response
        return response()->json(['data' => $student], 200);

    }

    public function storeStudent( $request){
        $student = Student::create([
            'name' =>  $request['name'],
            'email' => $request['email'],
            'password' =>Hash::make( $request['password']),
            'gender' => $request['gender'],
            'birth_date' => $request['birth_date'],
            'nationality_id' => $request['nationality_id'],
            'blood_id' => $request['blood_id'],
            'religion_id' => $request['religion_id'],
            'grade_id' =>$request['grade_id'],
            'class_id' => $request['class_id'],
            'section_id' =>$request['section_id'],
            'parent_id' => $request['parent_id'],
            'academic_year' =>$request['academic_year'] ,
        ]);
if($request->hasFile('photos')){
    foreach($request['photos'] as $photo){
        $name= time().'-'.uniqid().'.'.$photo->getClientOriginalExtension();
        $path =$photo->storeAs('attachments/students/'.$student['name'],$name,'attachment');

        Image::create([
            'file_name'=>$name,
            'imageable_id'=>$request['student_id'],
            'imageable_type'=>'App\Models\Student'
        ]);
    }
}

        return response()->json(
            [
            ' data' => $student,
            'message' => 'Student created successfully',
            ]
            , 201);

    }
    public function updateStudent( $request,$id){
        $student=Student::findorfail($id);
        $student->update($request->all());
     return response()->json([
        'data'=>$student,
        'message'=>'student updated successfully'
     ]);
    }
    public function deleteStudent( $request){

            $ids = $request->input('ids');

            if (empty($ids)) {
                return response()->json(['message' => 'No student IDs provided.'], 400);
            }

            // Assuming 'students' is the name of your students table
            Student::whereIn('id', $ids)->delete();

            return response()->json(['message' => 'Students deleted successfully.'], 200);
        }

        public function uplodeStudentImage( $request){
            $student=Student::findorfail($request['student_id']);
            foreach($request['photos'] as $photo){
                $name= time().'-'.uniqid().'.'.$photo->getClientOriginalExtension();
                $path =$photo->storeAs('attachemetns/students/'.$student['name'],$name,'attachment');

                Image::create([
                    'file_name'=>$name,
                    'imageable_id'=>$request['student_id'],
                    'imageable_type'=>'App\Models\Student'
                ]);

                return response()->json(['message' => 'images added successfully for '.$request['student_name']], 200);
            }
        }

        public function downloadImageStudentImage($id,$fileName){
            $student=Student::findorfail($id);
            return response()->download(public_path('attachemetns/students/'.$student['name'].'/'.$fileName));
        }

        public function deleteStudentPhoto($request) {
             $student=Student::findorfail($request['student_id']);

            // Delete the photo file from storage

                Storage::disk('attachment')->delete('attachemetns/students/'.$student['name'].'/'.$request['file_name']);

            // Delete the photo record from the database
            Image::where('file_name',$request['file_name'])->delete();
            return response()->json(['message' => 'Photo deleted successfully'], 200);
        }



}
