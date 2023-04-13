<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;











Route::get('welcome','App\Http\Controllers\WelcomController@welcome');
Route::get('soon','App\Http\Controllers\soonController@soon');

Route::get('banner','App\Http\Controllers\bannerController@banner');
Route::post('banner_by_id','App\Http\Controllers\bannerController@banner_by_id');

Route::get('games','App\Http\Controllers\GameController@games');
Route::post('game_by_id','App\Http\Controllers\GameController@game_by_id');
Route::post('game_countries','App\Http\Controllers\GameController@game_by_id');


Route::get('favorite_games','App\Http\Controllers\UserController@favorite_games');
Route::post('add_favorite','App\Http\Controllers\UserController@add_fav');

Route::get('cart_games','App\Http\Controllers\UserController@cart');
Route::post('add_cart','App\Http\Controllers\UserController@add_to_cart');


Route::post('packages','App\Http\Controllers\GameController@packages');

Route::post('search','App\Http\Controllers\GameController@search');

Route::get('mail','App\Http\Controllers\UserController@send');

Route::post('login','App\Http\Controllers\UserController@login');
Route::post('verify','App\Http\Controllers\UserController@verify');



