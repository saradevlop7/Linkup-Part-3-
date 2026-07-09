<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkUp</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- NAVBAR -->
<nav class="bg-white shadow sticky top-0">
    <div class="max-w-5xl mx-auto flex justify-between items-center py-4 px-5">

        <h1 class="text-3xl font-bold text-blue-600">
            LinkUp
        </h1>

        <div class="flex items-center gap-4">

            <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">
                {{ strtoupper(substr(Auth::user()->name,0,1)) }}
            </div>

            <span class="font-semibold">
                {{ Auth::user()->name }}
            </span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">

                    Logout

                </button>

            </form>

        </div>

    </div>
</nav>


<div class="max-w-3xl mx-auto mt-8">

    <!-- CREATE POST -->

    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">

        <h2 class="text-xl font-bold mb-4 text-gray-700">
            Create a post
        </h2>

        <form action="{{ route('posts.store') }}" method="POST">

            @csrf

            <textarea
                name="content"
                rows="4"
                placeholder="Share something with your network..."
                class="w-full border-2 border-gray-200 rounded-xl p-4 resize-none focus:outline-none focus:border-blue-500"></textarea>

            <button
                class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition">

                Publish

            </button>

        </form>

    </div>


    <!-- POSTS -->

    @forelse($posts as $post)

    <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">

        <div class="flex items-center gap-3">

            <div class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center text-xl font-bold">

                {{ strtoupper(substr($post->user->name,0,1)) }}

            </div>

            <div>

                <h2 class="font-bold text-lg">
                    {{ $post->user->name }}
                </h2>

                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>

            </div>

        </div>


        <p class="mt-5 text-gray-700 leading-7">

            {{ $post->content }}

        </p>
        <div class="flex items-center gap-6 mt-5 mb-5">

    <form action="{{ route('posts.like', $post) }}" method="POST">
        @csrf

        <button
            class="text-red-500 font-semibold hover:text-red-700 transition">

            ❤️ Like

        </button>

    </form>

    <span class="text-gray-500">
        ❤️ {{ $post->likes->count() }} Likes
    </span>

    <span class="text-gray-500">
        💬 {{ $post->comments->count() }} Comments
    </span>

</div>

<hr class="mb-5">

        <hr class="my-5">

        <!-- COMMENTS -->

        <h3 class="font-semibold text-gray-700 mb-4">
            Comments
        </h3>

        @forelse($post->comments as $comment)

        <div class="flex gap-3 mb-4">

            <div class="w-10 h-10 rounded-full bg-gray-400 text-white flex items-center justify-center font-bold">

                {{ strtoupper(substr($comment->user->name,0,1)) }}

            </div>

            <div class="bg-gray-100 rounded-2xl p-4 flex-1">

                <h4 class="font-semibold">

                    {{ $comment->user->name }}

                </h4>

                <p class="text-gray-600 mt-1">

                    {{ $comment->content }}

                </p>

                @if(Auth::id()==$comment->user_id)

                <form
                    action="{{ route('comments.destroy',$comment) }}"
                    method="POST"
                    class="mt-2">

                    @csrf
                    @method('DELETE')

                    <button class="text-red-500 text-sm hover:underline">

                        Delete

                    </button>

                </form>

                @endif

            </div>

        </div>

        @empty

        <p class="text-gray-400 mb-4">

            No comments yet.

        </p>

        @endforelse


        <!-- ADD COMMENT -->

        <form action="{{ route('comments.store',$post) }}" method="POST">

            @csrf

            <input
                type="text"
                name="content"
                placeholder="Write a comment..."
                class="w-full border rounded-xl p-3 focus:outline-none focus:border-blue-500"
                required>

            <button
                class="mt-3 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                Comment

            </button>

        </form>


        @if(Auth::id()==$post->user_id)

        <form
            action="{{ route('posts.destroy',$post) }}"
            method="POST"
            class="mt-4">

            @csrf
            @method('DELETE')

            <button
                class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-lg">

                Delete Post

            </button>

        </form>

        @endif

    </div>

    @empty

    <div class="bg-white rounded-xl shadow p-6 text-center text-gray-500">

        No posts available.

    </div>

    @endforelse

</div>

</body>
</html>
