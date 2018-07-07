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

 Route::get('/', function () {
     $threads = App\Thread::paginate(5);
     $categories = App\Category::all();
     return view('welcome')->with('threads', $threads)->with('categories', $categories);
 });


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('post', 'PostsController')->only(['store', 'edit', 'update', 'destroy']);

Route::resource('thread', 'ThreadController');


