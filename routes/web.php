<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // get all the posts from the database
    $posts = DB::table('forums')->get();
    // return the view with the posts
    return view('welcome', ['posts' => $posts]);
});

Route::get('/posts/{id}', function ($id) {
    $post = DB::table('forums')->find($id);
    $user = DB::table('users')->find($post->userId);

    $comments = DB::table('comments')->where('forum_id', $id)->get();
    return view('post', [
        'post' => $post,
        'user' => $user,
        'comments' => $comments
    ]);
});

// make a login page
Route::get('/login', function () {
    return view('login');
});

// make the post request for login to check the passwords and store the user in the session
Route::post('/login', function () {
    $user = DB::table('users')->where('email', request('email'))->first();
    if ($user && Hash::check(request('password'), $user->password)) {
        session(['user' => $user]);
        // redirect to the page they came from
        return redirect("/");
    }
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.'
    ]);
});

// make a register page
Route::get('/register', function () {
    return view('register');
});

// make the post request for register to store the user in the database
Route::post('/register', function () {
    $user = DB::table('users')->where('email', request('email'))->first();
    if ($user) {
        return back()->withErrors([
            'email' => 'The provided email is already in use.'
        ]);
    }
    DB::table('users')->insert([
        'username' => request('name'),
        'email' => request('email'),
        'password' => Hash::make(request('password'))
    ]);
    return redirect('/login');
});

// make a logout page
Route::get('/logout', function () {
    session()->forget('user');
    return redirect('/');
});

Route::get('/create', function () {
    if (!session('user')) {
        return redirect('/login');
    }
    return view('create', ['categories' => DB::table('categories')->get()]);
});

// post request for creating a post
Route::post('/create/posts', function () {
    // get the categories from the request
    $categories = request('categories');
    // make an alert if there are no categories
    if (!$categories) {
        return back()->withErrors([
            'categories' => 'You must select at least one category.'
        ]);
    }
    // make an alert with the categories
    $alert = "";
    foreach ($categories as $category) {
        $alert .= $category . ", ";
    }

    // insert the post into the database
    DB::table('forums')->insert([
        'userId' => request('userId'),
        'title' => request('title'),
        'content' => request('content'),
        'categories' => $alert
    ]);
    return redirect('/posts/' . DB::getPdo()->lastInsertId());
});

// make a profile page
Route::get('/profile/{id}', function ($id) {
    return view('profile', [
        'user' => DB::table('users')->find($id),
        'posts' => DB::table('forums')->where('userId', $id)->get()
    ]);
});

// make a profile edit page
Route::get('/profile/edit/{id}', function ($id) {
    // find the current logged in user
    $userId = session('user')->id;
    // check if the user is logged in and if they are the same user
    if (!session('user')) {
        return redirect('/login');
    }
    if($userId != $id) {
        return redirect('/profile/edit/' . $userId);
    }

    return view('profileEdit', ['user' => DB::table('users')->find($id)]);
});

// post request for editing a profile
Route::post('/profile/edit/{id}', function ($id) {
    // find the current logged in user
    $userId = session('user')->id;
    // check if the user is logged in and if they are the same user
    if (!session('user')) {
        return redirect('/login');
    }
    if($userId != $id) {
        return redirect('/profile/edit/' . $userId);
    }

    // update the user in the database
    DB::table('users')->where('id', $id)->update([
        'username' => request('username'),
        'email' => request('email'),
        'bio' => request('bio'),
    ]);
    return redirect('/profile/' . $id);
});

// make a search page
Route::get('/search', function () {
    // get the search query
    $search = request('search');
    // get the posts that match the search query
    $posts = DB::table('forums')->where('title', 'like', '%' . $search . '%')->get();

    // split the categories up after the comma into an array
    $categories = explode(", ", $search);
    // get the posts that match the categories
    $categoryPosts = DB::table('forums')->where('categories', 'like', '%' . $categories[0] . '%')->get();
    
    // return the search page with the posts and categories
    return view('search', [
        'posts' => $posts,
        'categoryPosts' => $categoryPosts,
        'search' => $search
    ]);
});

// make a category page
Route::get('/category/{id}', function ($id) {
    // get the category from the database
    $category = DB::table('categories')->find($id);
    // get the posts that match the category
    $posts = DB::table('forums')->where('categories', 'like', '%' . $category->name . '%')->get();
    // return the category page with the posts and category
    return view('category', [
        'posts' => $posts,
        'category' => $category
    ]);
});

// make a comment post request
Route::post('/posts/{id}/comment', function ($id) {
    // insert the comment into the database
    DB::table('comments')->insert([
        'forum_id' => $id,
        'userId' => request('userId'),
        'username' => request('username'),
        'content' => request('content')
    ]);
    return back();
});