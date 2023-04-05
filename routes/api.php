<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;











Route::get('welcome','App\Http\Controllers\WelcomController@welcome');
Route::get('soon','App\Http\Controllers\soonController@soon');
Route::get('banner','App\Http\Controllers\bannerController@banner');
Route::get('games','App\Http\Controllers\GameController@games');
Route::post('game_by_id','App\Http\Controllers\GameController@game_by_id');


Route::get('mail','App\Http\Controllers\UserController@send');





