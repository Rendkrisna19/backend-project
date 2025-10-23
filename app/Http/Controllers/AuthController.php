<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $r) {
        $data = $r->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
            'role'=>'in:admin,user'
        ]);
        $user = User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'role'=>$data['role'] ?? 'user'
        ]);
        $token = $user->createToken('api')->plainTextToken;
        return response()->json(['user'=>$user,'token'=>$token], 201);
    }

    public function login(Request $r) {
        $data = $r->validate(['email'=>'required|email','password'=>'required']);
        $user = User::where('email',$data['email'])->first();
        if (!$user || !Hash::check($data['password'],$user->password)) {
            throw ValidationException::withMessages(['email'=>['Kredensial salah.']]);
        }
        $user->tokens()->delete();
        $token = $user->createToken('api')->plainTextToken;
        return response()->json(['user'=>$user,'token'=>$token]);
    }

    public function me(Request $r) { return $r->user(); }

    public function logout(Request $r) {
        $r->user()->tokens()->delete();
        return response()->json(['message'=>'logout']);
    }
}
