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


Route::get('/sitemap.xml', 'SiteMapController@index');

Route::get('/', 'WebController@home')->name('home');
Route::get('/wp', 'WebController@wordpress')->name('wordpress');

Route::get('/associacio', 'WebController@associacio')->name('associacio');
Route::get('/fes-te-soci', 'WebController@festeSoci')->name('fes-te-soci');
Route::post('/fes-te-soci', 'WebController@sendSoci')->name('fes-te-soci.send');


Route::get('/socis', 'SocisController@socis')->name('socis');
Route::get('/socis/disciplina/{disciplina}', 'SocisController@disciplina')->name('socis.disciplina');
Route::get('/socis/{soci_slug}', 'SocisController@soci')->name('socis.soci');
Route::post('/socis', 'SocisController@search')->name('socis.search');

Route::get('/blog', 'BlogController@blog')->name('blog');
Route::get('/blog/category/{category}', 'BlogController@category')->name('blog.category');
Route::get('/blog/{post_slug}', 'BlogController@post')->name('blog.post');
Route::post('/blog', 'BlogController@search')->name('blog.search');


Route::group(['prefix' => 'backend','middleware' => ['auth']], function () {
    Route::get('/', 'BackController@index')->name('backend');
    Route::post('/', 'BackController@save')->name('soci.save');
    Route::post('/upload/{picture_type}', 'BackController@uploadPicture')->name('soci.upload');
    Route::post('/sort/{picture_type}', 'BackController@sortPictures')->name('soci.sort');
    Route::delete('/upload/{picture_type}/{image_id?}', 'BackController@removePicture')->name('soci.removepicture');
});
