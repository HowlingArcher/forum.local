<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="{{ asset('/css/loginRegister.css') }}">
</head>
<body>
    <!-- include the navbar -->
    @include('includes/navbar')

    <!-- make a login form -->
    <form action="/login" method="post" class="login-register">
        <h3>Login</h3>
        @csrf
        <input type="email" name="email" placeholder="email" required>
        <input type="password" name="password" placeholder="password" required><br>
        <button type="submit">Login</button> <button onclick="location.href='/register'">Register</button>
    </form>

</body>
</html>