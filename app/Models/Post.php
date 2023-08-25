<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'status',
        'published_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post_like()
    {
        return $this->hasMany(PostLike::class);
    }

    public function post_comment()
    {
        return $this->hasMany(PostComment::class);
    }
}
