<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkUp - Login</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 flex justify-center items-center min-h-screen">

<div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-md">

    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-blue-700">
            LinkUp
        </h1>

        <p class="text-gray-500 mt-2">
            Welcome Back 👋
        </p>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">

        @csrf

        <div class="mb-4">
            <input
                type="email"
                name="email"
                placeholder="Email"
                class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>

        <div class="mb-6">
            <input
                type="password"
                name="password"
                placeholder="Password"
                class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>

        <button
            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold transition">

            Login

        </button>

    </form>

    <p class="text-center mt-6 text-gray-600">

        Don't have an account?

        <a href="{{ route('register') }}"
           class="text-blue-600 font-semibold hover:underline">

            Register

        </a>

    </p>

</div>

</body>
</html>
