<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = ApiRequest::validator($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        if (!$validated['status']) return $validated['response'];

        if (User::where('email', $request->email)->first()) {
            return response()->json([
                'messages' => [
                    'Email already registered!',
                ]
            ], 400);
        }

        $user = User::create([
            'role_id' => 2,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'data' => [
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role()->name,
            ]
        ], 200);
    }

    public function login(Request $request)
    {
        $validated = ApiRequest::validator($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);
        if (!$validated['status']) return $validated['response'];

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'messages' => [
                    'Wrong email or password!',
                ]
            ], 401);
        }

        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('Api of '. $user->name)->plainTextToken;
        
        return response()->json([
            'data' => [
                'name' => $user->name,
                'role' => $user->role->name,
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer'
                ],
            ]
        ], 201);
    }

    public function getUser()
    {
        if ($user = Auth::user()) {
            return response()->json([
                'data' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role->name,
                ]
            ], 200);
        } else {
            return response()->json([
                'messages' => [
                    'You are unauthorized!',
                ]
            ], 401);
        }
    }

    public function logout()
    {
        if ($user = Auth::user()) {
            $user->currentAccessToken()->delete();
            
            return response()->json([
                'messages' => [
                    'Logout success!',
                ]
            ], 200);
        } else {
            return response()->json([
                'messages' => [
                    'You are unauthorized!',
                ]
            ], 401);
        }
    }
}
