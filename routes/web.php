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
Route::post('/socis', 'WebController@search')->name('socis.search');
Route::get('/blog/{post_slug?}', 'WebController@blog')->name('blog');
Route::get('/associacio', 'WebController@associacio')->name('associacio');
Route::get('/fes-te-soci', 'WebController@festeSoci')->name('fes-te-soci');

Route::group(['prefix' => 'backend','middleware' => ['auth']], function () {
    Route::get('/', 'BackController@index')->name('backend');
    Route::post('/', 'BackController@save')->name('soci.save');
    Route::post('/upload/{picture_type}', 'BackController@uploadPicture')->name('soci.upload');
    Route::post('/sort/{picture_type}', 'BackController@sortPictures')->name('soci.sort');
    Route::delete('/upload/{picture_type}/{image_id?}', 'BackController@removePicture')->name('soci.removepicture');
});
