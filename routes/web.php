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
    return view('welcome');
});

Auth::routes();
Route::resource('/post', 'PostController');
Route::post('/register', 'UserController@register');
Route::get('/user/{id}', 'UserController@show_user')->name('user.show');
Route::post('/user/edit/{id}', 'UserController@update_user')->name('user.update');
Route::get('/user/edit/{id}', 'UserController@edit_user')->name('user.edit');
Route::get('/dashboard', 'HomeController@dashboard')->name('home');
Route::get('/pengumuman', 'PostController@index');


