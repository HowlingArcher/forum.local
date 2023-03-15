<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category: {{ $category->name }}</title>
</head>
<body>
    <!-- include the navbar -->
    @include('includes/navbar')
    
    <!-- make a category page -->
    <h1>{{ $category->name }}</h1>
    
    <!-- make a list of posts -->
    @foreach ($posts as $post)
        <a href="/post/{{ $post->id }}">
            <h2>{{ $post->title }}</h2>
        </a>
        <p>{{ $post->content }}</p>
        <p>{{ $post->created_at }}</p>
    @endforeach
    
</body>
</html>