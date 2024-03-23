<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {
        $request->validate( [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
    if (!$user || !Hash::check($request->password, $user->password)) {
        // return response()->json([
        //     'message' => 'Invalid email or password'
        // ], 401);
            return redirect()->route('login')->with('error', 'Invalid email or password');
    }
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Authentication passed...
        return redirect()->route('suits');
    } 
    // $token = $user->createToken('my-app-token')->plainTextToken;
    //     // return response()->json(['token' => $token, 'user' => $user ]);

    //     return redirect()->route('suits');
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }
    public function test(Request $request){
        return response()->json(['message' => 'test out']);
    }

    public function signup(Request $request){
        $request->validate( [
            'name'=>'string|required|min:3|max:20',
            'email'=> 'required|email',
            'password'=> 'required|confirmed',
        ]);
        $user = User::create($request->all());
        $token = $user->createToken('my-app-token')->plainTextToken;
        return response()->json(['token' => $token, 'user' => $user ]);
    }


}
