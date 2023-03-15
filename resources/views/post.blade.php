<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>

    <link rel="stylesheet" href="{{ asset('/css/post.css') }}">
</head>
<body>
    <!-- include the navbar -->
    @include('includes/navbar')

    <div class="postContent">
        <h1>{{ $post->title }}</h1>
        <h3>Post created by: <a href="/profile/{{ $user->id }}">{{ $user->username }}</a></h3>
        <h3>Post created at: {{ $post->created_at }}</h3>
        <h3>Categories: {{ $post->categories }}</h3>
<br><br>
        <p>
            {{ $post->content }}
        </p>
    </div>


    <div class="comments">
        <h2>Comments</h2>

        @if(session('user'))
            
            <form action="/posts/{{ $post->id }}/comment" method="post">
                @csrf
                <input type="hidden" name="username" value="{{ session('user')->username }}">
                <input type="hidden" name="userId" value="{{ session('user')->id }}">
                <input type="text" name="content" placeholder="post a comment">
                <button type="submit">Comment</button>
            </form><br>
        @endif
        @if(!session('user'))
            <p><a href="/login">Log in</a> to comment</p><br>
        @endif

        @foreach ($comments as $comment)
            <a href="/profile/{{ $comment->userId }}"><h3>{{ $comment->username }}</h3></a>
            <p>{{ $comment->content }}</p>
        @endforeach
    </div>
    
</body>
</html>