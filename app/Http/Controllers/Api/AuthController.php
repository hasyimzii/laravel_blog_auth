<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request)
    {
        $validated = $request->validated();
        if ($validated == false) return back();

        $user = User::where('email', $request->email)->first();
        $passCheck = Hash::check($request->password, $user->password);

        if ($user && $passCheck) {
            $token = $user->generateToken();

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
