<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function hasRole($role)
    {
        if ($this->role()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function generateToken()
    {
        $token = Str::uuid()->toString();
        $this->update([
            'token' => $token,
        ]);
        return $token;
    }

    public static function validateToken($bearer_token)
    {   
        if (is_null($bearer_token)) return false;

        $token = explode(' ', $bearer_token);

        if ($token[0] != 'Bearer') return false;

        if (count($token) != 2) return false;

        if (!$user = User::where('token', $token[1])->first()) return false;

        return $user;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }
    
    public function post_like()
    {
        return $this->hasMany(PostLike::class);
    }

    public function post_comment()
    {
        return $this->hasMany(PostComment::class);
    }
    
    public function comment_like()
    {
        return $this->hasMany(CommentLike::class);
    }
}
