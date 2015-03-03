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

Route::get('/dvds/create', 'DvdsController@create');
Route::post('/dvds', 'DvdsController@postDvd');

Route::get('/', 'DvdsController@search');
Route::get('/dvds/search', 'DvdsController@search');

Route::get('/dvds', 'DvdsController@results');

Route::get('/dvds/{id}', 'DvdsController@reviews');
Route::post('/dvds/{id}', 'DvdsController@postReview');
