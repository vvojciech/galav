<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// User
Route::auth();
Route::get('/u/{username}', 'UsersController@show');

// Images
Route::get('/', 'ImagesController@index');
Route::get ('/upload', [
    'middleware' => 'auth',
    'uses' => 'ImagesController@create'
]);
Route::post('/upload', [
    'middleware' => 'auth',
    'uses' => 'ImagesController@store'
]);
Route::get('/i/{filename}', 'ImagesController@show');
Route::get('/s/', 'ImagesController@search');

// Voting
Route::get('/vote/{filename}/{vote_string}', 'VotesController@vote');
