<?php

use Illuminate\Support\Facades\Route;

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
})->name('home');

Route::group(['prefix' => 'user'],function () {
    Route::group(['middleware' => 'web'], function () {


        Route::post('/signup', [
            'uses' => 'UserController@postSignup',
            'as' => 'user.signup'
        ]);


        Route::post('/signin', [
            'uses' => 'UserController@postSignin',
            'as' => 'user.signin'
        ]);
        Route::get('/logout', [
            'uses' => 'UserController@logout',
            'as' => 'user.logout'
        ]);


    });
});

Route::post('/create_post', [
    'uses' => 'PostController@create',
    'as' => 'post.create'
]);

Route::get('/dashboard', [
    'uses' => 'PostController@dashboard',
    'as' => 'dashboard',
    'middleware' => 'auth'
]);
Route::post('/update_post',[
    'uses' => 'PostController@update',
    'as'   => 'post.update'
]);
Route::post('/like',[
    'uses' => 'PostController@like',
    'as'   => 'post.like'
]);
Route::get('/delete_post/{id}',[
    'uses' => 'PostController@delete',
    'as'   => 'post.delete'
]);
Route::post('/like_people',[
    'uses' => 'PostController@likePeople',
    'as'   => 'post.likePeople'
]);
