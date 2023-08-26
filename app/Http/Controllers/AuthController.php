<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                Alert::toast($message, 'error');
            }
            return back();
        }
 
        if (Auth::attempt($validator->validated())) {
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

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                Alert::toast($message, 'error');
            }
            return back();
        }

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
        return redirect()->back();
    }
}
