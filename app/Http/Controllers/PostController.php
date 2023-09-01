<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
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

    private function checkId($id)
    {
        $post = Post::find($id);
        if (is_null($post)) {
            Alert::toast('Post not found!', 'error');
            return false;
        }
        return $post;
    }

    public function show($id)
    {
        $post = $this->checkId($id);
        if ($post == false) return back();

        $post_comment = $post->post_comment()->orderBy('id', 'desc')->get();
        $post_like = $post->post_like()->orderBy('id', 'desc')->get();
        
        return view('dashboard.post.show', compact('post', 'post_comment', 'post_like'));
    }

    public function create()
    {
        return view('dashboard.post.create');
    }

    public function store(PostRequest $request)
    {
        $validated = $request->validated();
        if ($validated == false) return back();

        Post::create([
            'user_id' => auth()->user()->id,
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
        if ($post == false) return back();

        return view('dashboard.post.edit', compact('post'));
    }

    public function update(PostRequest $request, $id)
    {
        $post = $this->checkId($id);
        if ($post == false) return back();
        
        $validated = $request->validated();
        if ($validated == false) return back();

        $post->update([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
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

        if ($post == false) return back();

        $post->delete();

        Alert::toast('Delete post success!', 'success');
        return back();
    }
}
