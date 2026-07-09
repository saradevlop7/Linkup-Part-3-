<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
    ];

    // Auteur du post
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Commentaires du post
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Likes du post
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
