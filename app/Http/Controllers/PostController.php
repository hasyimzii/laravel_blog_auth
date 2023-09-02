<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    private function checkId($id)
    {
        $post = Post::find($id);
        if (is_null($post)) {
            Alert::toast('Post not found!', 'error');
            return false;
        }
        return $post;
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            $post = Post::orderBy('id', 'desc')->get();
        } else {
            $post = Post::where('user_id', $user->id)->orderBy('id', 'desc')->get();
        }
        return view('dashboard.post.index', compact('post'));
    }

    public function show($id)
    {
        $post = $this->checkId($id);
        if (!$post) return back();

        $post_comment = $post->post_comment()->orderBy('id', 'desc')->get();
        $post_like = $post->post_like()->orderBy('id', 'desc')->get();
        
        return view('dashboard.post.show', compact('post', 'post_comment', 'post_like'));
    }

    public function create()
    {
        return view('dashboard.post.create');
    }

    public function store(Request $request)
    {
        $validated = WebRequest::validator($request->all(), [
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
            'status' => ['required', 'string'],
        ]);
        if (!$validated) return back();

        Post::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
            'published_date' => ($request->status == 'published') ? date('Y-m-d H:i:s') : null,
        ]);
 
        Alert::toast('Create post success!', 'success');
        return to_route('dashboard.post.index');
    }
    
    public function edit($id)
    {
        $post = $this->checkId($id);
        if (!$post) return back();

        return view('dashboard.post.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = $this->checkId($id);
        if (!$post) return back();
        
        $validated = WebRequest::validator($request->all(), [
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
            'status' => ['required', 'string'],
        ]);
        if (!$validated) return back();

        $post->update([
            'title' => ($request->title) ?: $post->title,
            'content' => ($request->content) ?: $post->content,
            'status' => ($request->status) ?: $post->status,
            'published_date' => ($post->status != 'published' && $request->status == 'published')
                                ? date('Y-m-d H:i:s')
                                : $post->published_date,
        ]);
 
        Alert::toast('Update post success!', 'success');
        return to_route('dashboard.post.index');
    }

    public function delete($id)
    {
        $post = $this->checkId($id);
        if (!$post) return back();

        $post->delete();

        Alert::toast('Delete post success!', 'success');
        return back();
    }
}
