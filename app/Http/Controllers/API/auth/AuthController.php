<?php

namespace App\Http\Controllers\API\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TheParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{


    //teacher login



    public function teacherLogin(LoginRequest $request){
        if(!Auth::attempt($request->only('email','password'))){
            return response()->json([
                'data'=>[],
                'message'=> 'password or email is wrong'
            ]);
        }
        $teacher = Teacher::where('email', $request->email)->first();
        $token= $teacher->createToken('mobile', ['role:teacher'])->plainTextToken;

        $data['teacher']= $teacher;
        $data['token']=$token;
        return response()->json([
            'data'=>$data,
            'message'=> 'teacher loged in successfuly'
        ] );


    }

    //parentlogin
    public function parentLogin(Request $request){
        $parent = TheParent::where('father_passport_id', $request->father_passport_id)->first();

        if (!$parent || ($request->phone != $parent->father_phone )) {
            throw ValidationException::withMessages([
                'phone' => ['The provided credentials are incorrect.'],
            ]);
        }
        return response()->json([
            'parent' => $parent,
            'token' => $parent->createToken('mobile', ['role:parent'])->plainTextToken
        ]);
    }

    //student login
    public function studentLogin(LoginRequest $request){
        if(!Auth::attempt($request->only('email','password'))){
            return response()->json([
                'data'=>[],
                'message'=> 'password or email is wrong'
            ]);
        }
        $student = Student::where('email', $request->email)->first();
        $token=$student->createToken('mobile', ['role:student'])->plainTextToken;
        $data['student']=$student;
        $data['token']=$token;
        return response()->json([
            'data'=>$data,
            'message'=> 'teacher loged in successfuly'
        ] );

    }

}
