<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request)
    {
        $validated = $request->validated();
        if ($validated == false) return back();
 
        if (Auth::attempt($validated)) {
            return response()->json([
                'data' => [
                    'name' => Auth::user()->name,
                ]
            ], 201);
        } else {
            return response()->json([
                'messages' => [
                    'Wrong email or password!',
                ]
            ], 401);
        }
    }
}
