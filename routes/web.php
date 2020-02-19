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

Auth::routes();

Route::get('/', 'WebController@home')->name('home');
Route::get('/socis/{soci_slug?}', 'WebController@socis')->name('socis');
Route::get('/blog/{post_slug?}', 'WebController@blog')->name('blog');
Route::get('/associacio', 'WebController@associacio')->name('associacio');
Route::get('/fes-te-soci', 'WebController@festeSoci')->name('fes-te-soci');

Route::group(['prefix' => 'backend','middleware' => ['auth']], function () {
    Route::get('/', 'BackController@index')->name('backend');
    Route::post('/', 'BackController@save')->name('soci.save');
});
