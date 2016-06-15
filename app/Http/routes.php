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
Route::get('/u/{username}', 'UsersController@uploaded');
Route::get('/u/{username}/favourites', 'UsersController@favourites');


// Social Auth
Route::get('/auth/facebook', 'Auth\AuthController@authFacebookRedirect');
Route::get('/auth/facebook/callback', 'Auth\AuthController@authFacebookHandle');
Route::get('/auth/google', 'Auth\AuthController@authGoogleRedirect');
Route::get('/auth/google/callback', 'Auth\AuthController@authGoogleHandle');
Route::get('/auth/twitter', 'Auth\AuthController@authTwitterRedirect');
Route::get('/auth/twitter/callback', 'Auth\AuthController@authTwitterHandle');


// Image Files @todo support for other extensions
Route::get('/i/{filename}-{size}.jpg', 'ImagesController@file')
    ->where(['filename' => '[A-Za-z0-9]+', 'size' => '[t]']);

Route::get('/i/{filename}.jpg', 'ImagesController@file');


// Images
Route::get('/', 'ImagesController@index'); // default - by rating
Route::get('/all/{sort}/{page?}', 'ImagesController@index'); // by rating

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


// Favourites
Route::post('/favourite/', 'FavouritesController@toggle');


// Comments
Route::post('/comment/', 'CommentsController@store');
