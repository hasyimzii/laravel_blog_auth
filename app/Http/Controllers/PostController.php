<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::all();
        return view('dashboard.post.index', compact('post'));
    }

    public function create()
    {
        return view('dashboard.post.create');
    }

    public function store(Request $request)
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

        $user = Post::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->assignRole('user');
 
        Alert::toast('Register account success!', 'success');
        return to_route('auth.showLogin');
    }

    public function delete()
    {
        Alert::toast('Delete post success!', 'success');
        return back();
    }
}
