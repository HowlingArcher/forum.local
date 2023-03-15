<div class="nav-bar">
    <a href="/" class="actives">Home</a>

    <!-- check if there is a user in the session -->
    @if (session('user'))
        <a href="/create">Create post</a>
        <a href="/profile/{{ session('user')->id }}">Profile</a>
        <a href="/logout">Logout</a>
    @else
        <a href="/login">Login</a>
        <a href="/register">Register</a>
    @endif

    <form action="/search" method="get" class="search">
        <input type="text" name="search" placeholder="search for a tag or a title!">
        <button type="submit">Search</button>
    </form>
</div>

<link rel="stylesheet" href="{{ asset('/css/navbar.css') }}">