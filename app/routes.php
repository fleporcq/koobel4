<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('/books', 'BookController@get');
Route::get('/covers/{slug}.jpg', 'BookController@cover');
Route::get('/login', 'SecurityController@showLogin');
Route::post('/login', 'SecurityController@login');
Route::get('/logout', 'SecurityController@logout');
Route::get('/books/upload', 'BookController@upload');
Route::any('/books/flow', 'BookController@flow');
