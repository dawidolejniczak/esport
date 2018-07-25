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
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::post('login', '\App\Http\Controllers\Auth\LoginController@login');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');

Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');

Route::get('/', 'PostsController@index');


Route::resource('posts', PostsController::class, ['only' => [
    'show', 'index', 'store', 'create'
]]);

Route::get('queue', 'PostsController@queue')->name('queue');

Route::resource('users', UsersController::class, ['only' => [
    'store', 'update'
]]);

Route::get('myprofile', 'UsersController@edit')->name('myProfile');

Route::get('password/edit', 'PasswordsController@edit')->name('password.edit');

Route::resource('password', PasswordsController::class, ['only' => [
    'update'
]]);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
