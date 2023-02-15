<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;


class AuthController extends Controller
{
    public function register (Request $request){

        $fields = $request->validate([
            'name' => 'string|required',
            'email'=> 'required|string|unique:users,email',
            'password'=> 'required|string|confirmed'
        ]);

        $user = User::create([
            'name'=> $fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password'])
        ]);

        $token = $user->createToken($fields['email'])->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        $token = request()->bearerToken();
        

        return [
            'message'=>'logged out',
            'tk'=>$token
        ];
    }
    public function login (Request $request){

        $fields = $request->validate([
            'email'=> 'required|string',
            'password'=> 'required|string'
        ]);

      $user = User::where('email', $fields['email'])->first();

      if(!$user || !Hash::check($fields['password'], $user->password)){
        return response([
            'message'=>'No Username or wrong password'
        ],401);
      }


        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function showtokens(Request $request){
        return PersonalAccessToken::all();
    }
    
    public function showuser(Request $request){
        return User::all();
    }
}


