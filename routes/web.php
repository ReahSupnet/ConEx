<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//
//     $threads = App\Thread::orderBy('created_at', 'desc')->paginate(3);
//     $categories = App\Category::all();
//     return view('welcome')->with('threads', $threads)->with('categories', $categories);
// });


Auth::routes();

Route::get('/', 'ThreadController@index');

Route::get('/my_posts', 'ThreadController@myPosts')->name('my_posts');


Route::get('/home', 'ThreadController@index');

Route::resource('/post', 'PostsController')->only(['store', 'edit', 'update', 'destroy']);

Route::resource('/category', 'CategoryController')->only(['store', 'destroy']);

Route::resource('/thread', 'ThreadController');

// Vote endpoints
Route::put('/post/{post}/vote_up', 'PostsController@voteUp');
Route::put('/post/{post}/vote_down', 'PostsController@voteDown');
Route::put('/thread/{thread}/vote_up', 'ThreadController@voteUp');
Route::put('/thread/{thread}/vote_down', 'ThreadController@voteDown');

Route::resource('/user', 'UserController')->only(['store', 'index', 'show', 'destroy']);
Route::get('/admin', 'UserController@admin');




