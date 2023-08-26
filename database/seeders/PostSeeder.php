<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'user_id' => 1,
            'title' => 'My First Post',
            'content' => '<p><b>Hello!<b> This is my first post</p>',
            'status' => 'draft',
        ]);
    }
}
