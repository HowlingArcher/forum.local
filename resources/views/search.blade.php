<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Searching for: {{ $search }}</title>

    <link rel="stylesheet" href="{{ asset('/css/search.css') }}">
</head>
<body>
    @include('includes/navbar')

    <div class="results">
        @foreach ($posts as $post)
            <a href="/post/{{ $post->id }}">
                <h2>{{ $post->title }}</h2>
            </a>
            <p>{{ substr($post->content, 0, 60) }}</p>
            
            <p>{{ $post->categories }}</p>

            <p>{{ $post->created_at }}</p>
        @endforeach

        @foreach ($categoryPosts as $categorypost)
            <a href="/posts/{{ $categorypost->id }}">
                <h2>{{ $categorypost->title }}</h2>
            </a>
            <p>{{ substr($categorypost->content, 0, 60) }}</p>
            
            <p>{{ $categorypost->categories }}</p>
            
            <p>{{ $categorypost->created_at }}</p>
        @endforeach

        @if (count($posts) == 0 && count($categoryPosts) == 0)
            <h2>No results found for: {{ $search }}</h2>
        @endif
    </div>
</body>
</html>