<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user) {
            return response()->json(['message' => 'email/password salah'], 400);
        }

        if(!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'email/password salah'], 400);
        }

        $token = $user->createToken('access_token');
        return response()->json([
            'token' => $token->plainTextToken
        ]);
    }
}
