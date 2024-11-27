<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request) {
        $userData = $request->validate([ 
            'first_name'=>'required|string',   
            'last_name'=>'required|string',   
            'phone'=>'required|string',   
            'email'=>'required|string|email|unique:users',
            'password'=>'required|min:8|confirmed'
        ]);

        if (Auth::attempt($userData)) {
            return response()->json(['error'=>'Invalid Credentials']);
        }

        User::create([
            'first_name'=> $userData['first_name'],
            'last_name'=> $userData['last_name'],
            'phone'=> $userData['phone'],
            'name'=> $userData['name'],
            'email'=> $userData['email'],
            'password'=> Hash::make($userData['password']),
        ]);

        return response()->json(['message' => 'user registered successfully']);
    }

    public function login(Request $request) {
        $userData = $request->validate([    
            'email'=>'required|string|email',
            'password'=>'required|min:8'
        ]);

        if (!Auth::attempt($userData)) {
            return response()->json(['error'=>'Invalid Credentials']);
        }
        else{
            $user = Auth::user();
            $token = $user->createToken('API token')->plainTextToken;
    
            return response()->json(['token' =>$token]) ;
        }

        return response()->json(['message' =>'Unauthorized']) ;
        
       // dd($request->all());
    }

    public function logout(Request $request) {  
        $request->user()->tokens->each(function($token){
            $token->delete();
        });

        return response()->json(['message'=> 'Logged out succesfully']);
    }

    
}
