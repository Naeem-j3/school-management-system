<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            "name"=>["required"],
            "email"=> ["required","unique:users,email","email"],
            "password"=> ["required","confirmed"],
            ],['email.unique'=>'email is exist']);
            $user = User::create([
                "name"=> $request["name"],
                "email"=> $request["email"],
                "password"=> bcrypt($request["password"]),
            ]);
           $token= $user->createToken("")->plainTextToken;
           $data=[];
           $data["user"]= $user;
           $data['token']= $token;
           return response()->json([
            'data'=>$data,
            'message'=> 'user registerd successfuly'
        ]);

    }
    
    public function login(LoginRequest $request){

        if(!Auth::attempt($request->only('email','password'))){
            return response()->json([
                'data'=>[],
                'message'=> 'password or email is wrong'
            ]);
        }
        $user = User::where('email',$request->email)->first();
        $token= $user->createToken('mobile', ['role:admin'])->plainTextToken;

        $data['user']= $user;
        $data['token']=$token;
        return response()->json([
            'data'=>$data,
            'message'=> 'user loged in successfuly'
        ] );

    }
    public function logout(){
        Auth::user()->currentAccessToken()->delete();
        return response()->json(['message'=>'you are loged out'] );
    }
}
