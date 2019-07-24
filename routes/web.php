<?php

App::bind('TestClass123', function(){
    return new \App\Billing\Stripe(config('services.stripe.secret'));
});

$stripe = resolve('TestClass123');

//dd($stripe);


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'PagesController@index');
Route::get('/blog', 'PostController@index');
Route::get('/blog/{id}/{title}', ['uses' =>'PostController@single_blog']);
Route::get('/notes', 'PagesController@notes');

// ============== authendicated routes =====================/
Auth::routes();

Route::prefix('members')->middleware(['auth','can:isUser'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profile', 'HomeController@profile');
    Route::get('/profile/edit', 'HomeController@edit');
    Route::post('/profile/update', 'HomeController@update');
    Route::get('/my-posts', 'PostController@posts_by_member');
    Route::resource('/blog', 'PostController');
});


Route::prefix('admin')->middleware(['auth','can:isAdmin'])->group(function () {
    Route::get('/dashboard', 'admin\DashboardController@index')->name('dashboard');
    //Route::resource('/users', 'admin\MemberController');
    Route::get('/users', 'admin\MemberController@userslistReact');
    Route::get('/users/add', 'admin\MemberController@userslistReact');
    Route::get('/users/edit/{id}', 'admin\MemberController@userslistReact');
    Route::resource('/posts', 'admin\PostController');
    Route::get('/posts-by-user/{id}', ['uses' =>'admin\PostController@index']);
});
