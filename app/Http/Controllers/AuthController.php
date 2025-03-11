<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidation;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Exception;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register (StoreUserRequest $request) {

        if(User::where('email', $request->email)->exists()) {
            return response()->json([
                'message' => 'User Already Exists'
            ], 400);
        }
        $user = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password),
            'role_id' => 2
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(LoginValidation $request) {

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user['password'])) {
            return response()->json([
                'message' => 'Bad Credentials'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout(Request $request) {

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Disconnected',
        ]);
    }
}
