<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const ADMIN_ROLE_ID = 1;
    const USER_ROLE_ID = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // User has many posts
    public function posts()
    {
        return $this->hasMany(Post::class)->latest();
    }

    // User has many follows(user follows many people)
    public function follows()
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    // user has many followers
    public function followers()
    {
        return $this->hasMany(Follow::class, 'followed_id');
    }

    //return true if user is followed (by logged-in user)
    public function isFollowed()
    {
        return $this->followers()->where('follower_id', Auth::user()->id)->exists();
    }

    // return true if the user follows loggen-in user
    public function isFollower()
    {
        return $this->follows()->where('followed_id', Auth::user()->id)->exists();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
