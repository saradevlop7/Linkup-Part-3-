<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - LinkUp</title>
</head>
<body>

    <h2>Create Account</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red;">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ url('/register') }}" method="POST">
        @csrf

        <p>
            <input type="text" name="name" placeholder="Full Name" required>
        </p>

        <p>
            <input type="email" name="email" placeholder="Email" required>
        </p>

        <p>
            <input type="password" name="password" placeholder="Password" required>
        </p>

        <p>
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
        </p>

        <button type="submit">Register</button>

    </form>

    <br>

    <a href="{{ url('/login') }}">Already have an account? Login</a>

</body>
</html>
