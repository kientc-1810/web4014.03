<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(){
        return response()->json(User::all());
    }

    public function login(Request $request){
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response()->json([
                'message' => 'Bad credentials'
            ], 401);
        }

        $token = $user->createToken('inventoryapp')->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => $user
        ], 200);
    }
}
