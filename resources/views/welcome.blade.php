<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    </head>
    <body>
        @include('includes/navbar')

        <div class="forums">
            @foreach ($posts as $post)
                <p class="post">
                    <a href="/posts/{{ $post->id }}">
                        <h1>{{ $post->title }}</h1>
                    </a>
                    <p>
                        {{ substr($post->content, 0, 60) }}...
                    </p>
            
                    <p>{{ $post->categories }}</p>
                    
                    <p>{{ $post->created_at }}</p>
                </p>
            @endforeach
        </div>
    </body>
</html>
