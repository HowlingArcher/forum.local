<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $user->username }}</title>

        <link rel="stylesheet" href="{{ asset('/css/editprofile.css') }}">
    </head>
    <body>
        <!-- include the navbar -->
        @include('includes/navbar')
        
        <!-- make a profile page but let the user change the values of the email, username and avatar -->
        <form action="/profile/edit/{{ $user->id }}" method="post" class="editForm">
            @csrf
            <input type="text" name="username" value="{{ $user->username }}"><br>
            <input type="email" name="email" value="{{ $user->email }}"><br>
            <input type="text" name="bio" value="{{ $user->bio }}"><br>
            <button type="submit">Save changes</button>
        </form>
        
    </body>
</html>