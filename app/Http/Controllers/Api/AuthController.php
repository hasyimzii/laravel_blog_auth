<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = ApiRequest::validator($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);
        if (!$validated['status']) return $validated['response'];

        $user = User::where('email', $request->email)->first();
        $passCheck = Hash::check($request->password, $user->password);

        if ($user && $passCheck) {
            $token = $request->user()->createToken('Api '. $user->name)->plainTextToken;

            return response()->json([
                'data' => [
                    'name' => $user->name,
                    'role' => $user->role()->name,
                    'authorization' => [
                        'token' => $token,
                        'type' => 'bearer'
                    ],
                ]
            ], 201);
        } else {
            return response()->json([
                'messages' => [
                    'wrong email or password!',
                ]
            ], 401);
        }
    }

    public function logout()
    {
        $user = Auth::user();
        $user->update([
            'token' => null,
        ]);

        return response()->json([
            'messages' => [
                'logout success!',
            ]
        ], 200);
    }
}
