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
//     $posts = Post::type('page')->published()->get();
//     // dump($posts);

//     // $users = User::get();
//     // dd($users);
//     return view('home');
// });

Route::group(['prefix' => 'backend','middleware' => ['auth']], function () {
    // Route::get('/', function () {
    //     $users = User::get();
    //     return view('home',compact('users'));
    //     // dd($users);
       
    // });
});

Auth::routes();

Route::get('/', 'WebController@home')->name('home');
Route::get('/socis/{soci_slug?}', 'WebController@socis')->name('socis');
Route::get('/blog/{post_slug?}', 'WebController@blog')->name('blog');
Route::get('/associacio', 'WebController@associacio')->name('associacio');
Route::get('/fes-te-soci', 'WebController@festeSoci')->name('fes-te-soci');

Route::group(['prefix' => 'backend','middleware' => ['auth']], function () {
    Route::get('/', 'BackController@index')->name('backend');
});
