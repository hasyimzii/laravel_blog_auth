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

    private function checkId($id)
    {
        $post = Post::find($id);
        if (is_null($post)) {
            Alert::toast('Post not found!', 'error');
            return false;
        }
        return $post;
    }

    public function post($id)
    {
        $post = $this->checkId($id);
        if ($post == false) return back();

        $post_comment = $post->post_comment()->orderBy('id', 'desc')->get();
        $post_like = $post->post_like()->orderBy('id', 'desc')->get();
        
        return view('post', compact('post', 'post_comment', 'post_like'));
    }
}
