<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Afficher tous les posts
    public function index()
    {
        $posts = Post::with([
            'user',
            'comments.user',
            'likes'
        ])->latest()->get();

        return view('feed', compact('posts'));
    }

    // Ajouter un post
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:1000',
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return back()->with('success', 'Post publié avec succès.');
    }

    // Supprimer son propre post
    public function destroy(Post $post)
    {
        if ($post->user_id != Auth::id()) {
            abort(403);
        }

        $post->delete();

        return back()->with('success', 'Post supprimé.');
    }
}
