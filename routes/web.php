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

Route::get('/', 'PostController@list')->name('home');
Route::get('/login', 'UserController@login')->name('user.login');
Route::post('/login', 'UserController@login')->name('user.login');
Route::get('/logout', 'UserController@logout')->name('user.logout');
Route::get('/register', 'UserController@register')->name('user.register');
Route::post('/register', 'UserController@create')->name('user.register');
Route::get('/post/add', 'PostController@add')->name('post.add');
Route::post('/post/add', 'PostController@create')->name('post.add');
Route::post('/post/edit', 'PostController@edit')->name('post.update');
Route::post('/post/delete', 'PostController@delete')->name('post.delete');
Route::get('/post/exportall', 'PostController@exportAll')->name('post.exportAll');
Route::post('/post/import', 'PostController@import')->name('post.import');
// Notification router
Route::get('/notification', 'NotificationController@index')->name('notification.index');
Route::post('/notification', 'NotificationController@send')->name('notification.send');
Route::get('/chat', 'ChatController@index')->name('chat.index');
Route::post('/chat', 'ChatController@send')->name('chat.send');
