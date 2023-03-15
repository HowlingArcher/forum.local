<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create post</title>

    <link rel="stylesheet" href="{{ asset('/css/create.css') }}">
</head>
<body>
    @include('includes/navbar')
    
    <form action="/create/posts" method="post" class="createForm">
        @csrf
        <input type="hidden" name="userId" value="{{ session('user')->id }}">
        <input type="text" name="title" placeholder="title"><br>
        <textarea type="" name="content" placeholder="content"></textarea><br>
        
        <!-- add the categories to an array -->
        <h4>Categories/tags</h4>
        <select name="categories[]" multiple size="10" class="width-controll">
            @foreach ($categories as $category)
                <option value="{{ $category->name }}">{{ $category->name }}</option><br>
            @endforeach
        </select>
        <br>
        <h5>To select multiple press ctrl + click</h5>
        <br>
        <button type="submit">Create post</button>
    </form>
</body>
</html>