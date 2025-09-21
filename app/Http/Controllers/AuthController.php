<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',    
            'password' => 'required|min:8|confirmed',
        ]);
/**  @var \App\Model\User $user  */

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),    
        ]);

        $token = $user->createToken('main')->plainTextToken; 
        
        return response([
            'user' => $user, 
            'token' => $token
        ]);


    }
    public function login(Request $request) {

        $data = $request->validate([
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string'
        ]);


        if(!Auth::attempt($data)) {
            return response([
                'message' => 'The provided credentials are incorrect'
            ], 422);
        }

        $user =  Auth::user();

        $token =  $user->createToken('main')->plainTextToken; 


        return response([
            'user' => $user, 
            'token' => $token
        ]);
    }

    public function logout(Request $request) {

        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return response([
            'message' => 'Logged out'
        ]);

    }
}