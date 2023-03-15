<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('/css/loginRegister.css') }}">
</head>
<body>
    <!-- include the navbar -->
    @include('includes/navbar')

    <!-- make a register form -->
    <form action="/register" method="post" class="login-register">
        <h3>Register</h3>
        @csrf
        <input type="text" name="name" placeholder="name" required>
        <input type="email" name="email" placeholder="email" required>
        <input type="password" name="password" placeholder="password" required><br>
        <button type="submit">Register</button> <button onclick='location.href="/login"'>Login</button>
    </form>
    
</body>
</html>