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


// Image Files
Route::get('/i/{filename}.jpg', 'ImagesController@file');


// Images
Route::get('/', 'ImagesController@index'); // default - by rating
Route::get('/all/{sort}', 'ImagesController@index'); // by rating

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


// Reporting
Route::post('/report/', 'ReportsController@report');
