<?php

namespace Database\Seeders;

use App\Models\CommentLike;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostLike;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $post = Post::create([
            'user_id' => 1,
            'title' => 'My First Post',
            'content' => '<p><b>Hello!<b> This is my first post</p>',
            'status' => 'draft',
        ]);
        PostLike::create([
            'post_id' => $post->id,
            'user_id' => 1,
            'is_like' => true,
        ]);
        $comment = PostComment::create([
            'post_id' => $post->id,
            'user_id' => 1,
            'comment' => 'Good job!',
        ]);
        CommentLike::create([
            'post_comment_id' => $comment->id,
            'user_id' => 1,
            'is_like' => true,
        ]);
    }
}
