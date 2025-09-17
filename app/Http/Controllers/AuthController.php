<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',    
            'password' => 'required|min:8|confirmed',
        ]);
/*   @var \App\Model\User $user  */

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),    
        ]);

        $token = "1234567890"; // $user->createToken('main')->plainTextToken; 
        
        return response([
            'user' => $user, 
            'token' => $token
        ]);


    }
    public function login(Request $request) {

    }
}
