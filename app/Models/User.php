<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'headline',
        'company',
        'image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Les posts de l'utilisateur
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Les commentaires de l'utilisateur
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Les likes de l'utilisateur
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Les utilisateurs que je suis
    public function following()
    {
        return $this->belongsToMany(
            User::class,
            'follows',
            'follower_id',
            'user_id'
        );
    }

    // Les utilisateurs qui me suivent
    public function followers()
    {
        return $this->belongsToMany(
            User::class,
            'follows',
            'user_id',
            'follower_id'
        );
    }
}
