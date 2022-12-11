<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/user','App\Http\Controllers\UserController@index');

Route::post('/user/create','App\Http\Controllers\UserController@store');



Route::put('/user/{user}','App\Http\Controllers\UserController@update');
Route::delete('user/{user}','App\Http\Controllers\UserController@destroy');
// Route::get('user/{user}/albums','App\Http\Controllers\UserController@getAlbums');




Route::group(["middleware" => "auth:api"], function () {
    Route::get('/user/{user}','App\Http\Controllers\UserController@show');
    
    Route::post('/album/create','App\Http\Controllers\AlbumController@store');
    Route::get('album/{album}','App\Http\Controllers\AlbumController@show');
    Route::put('album/{album}','App\Http\Controllers\AlbumController@update');
    Route::delete('album/{album}','App\Http\Controllers\AlbumController@destroy');
    // Route::get('album/{album}/courses','App\Http\Controllers\AlbumController@getCourses');
});