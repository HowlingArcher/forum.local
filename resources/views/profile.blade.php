<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->username }}</title>

    <link rel="stylesheet" href="{{ asset('/css/profile.css') }}">
</head>
<body>
    @include('includes/navbar')
    
    <div class="userInfo">
        <h1>{{ $user->username }}</h1>
        <p>{{ $user->bio }}</p>
        
        @if(session('user'))
            @if(session('user')->id == $user->id)
                <a href="/profile/edit/{{ $user->id }}">Edit profile</a>
            @endif
        @endif
    </div>

    <div class="userPosts">
        <h2>{{ $user->username }}'s posts</h2><br>
        @foreach ($posts as $post)
            <a href="/posts/{{ $post->id }}">
                <h2>{{ $post->title }}</h2>
            </a>
            <p>{{ substr($post->content, 0, 60) }}</p>
            <p>{{ $post->created_at }}</p>
        @endforeach
    </div>
    
</body>
</html>