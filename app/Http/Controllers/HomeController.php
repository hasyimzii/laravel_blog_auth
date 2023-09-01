<?php

namespace App\Http\Controllers;

use App\Models\Post;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        $post = Post::orderBy('id', 'desc')->get();
        return view('home', compact('post'));
    }
}
