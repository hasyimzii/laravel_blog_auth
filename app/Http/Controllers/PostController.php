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
        $user = auth()->user();
        if ($user->hasRole('admin')) {
            $post = Post::all();
        } else {
            $post = Post::where('user_id', $user->id)->get();
        }
        return view('dashboard.post.index', compact('post'));
    }

    public function show($id)
    {
        $post = Post::find($id);
        $post_comment = $post->post_comment()->get();
        $post_like = $post->post_like()->get();
        return view('dashboard.post.show', compact('post', 'post_comment', 'post_like'));
    }

    public function create()
    {
        return view('dashboard.post.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
            'status' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                Alert::toast($message, 'error');
            }
            return back();
        }


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
        $post = Post::find($id);
        return view('dashboard.post.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
            'status' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                Alert::toast($message, 'error');
            }
            return back();
        }

        $post = Post::find($id);
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
        $post = Post::find($id);

        if (is_null($post)) {
            Alert::toast('Post not found!', 'error');
            return back();
        }
        $post->delete();

        Alert::toast('Delete post success!', 'success');
        return back();
    }
}
