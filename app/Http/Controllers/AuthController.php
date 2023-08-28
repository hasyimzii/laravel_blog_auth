<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
    
    public function login(AuthLoginRequest $request)
    {
        $validated = $request->validated();
        if ($validated == false) return back();

        $remember = ($request->remember) ? true : false;
 
        if (Auth::attempt($validated, $remember)) {
            $request->session()->regenerate();
            Alert::toast('Welcome to dashboard, '. auth()->user()->name .'!', 'success');
            return to_route('dashboard.post.index');
        } else {
            Alert::toast('wrong email or password!', 'error');
            return back();
        }
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(AuthRegisterRequest $request)
    {
        $validated = $request->validated();
        if ($validated == false) return back();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->assignRole('user');
 
        Alert::toast('Register account success!', 'success');
        return to_route('auth.showLogin');
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return to_route('home');
        }
        return back();
    }
}
