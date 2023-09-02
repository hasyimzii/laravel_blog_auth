<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        $validated = WebRequest::validator($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);
        if (!$validated) return back();

        $remember = ($request->remember) ? true : false;
 
        if (Auth::attempt($validated, $remember)) {
            $request->session()->regenerate();

            Alert::toast('Welcome to dashboard, '. Auth::user()->name .'!', 'success');
            return to_route('dashboard.index');
        } else {
            Alert::toast('Wrong email or password!', 'error');
            return back();
        }
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = WebRequest::validator($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if (!$validated) return back();

        $user = User::create([
            'role_id' => 2,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
 
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
