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

// laravel passport authentication
Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

// user register and login routes for authentication
Route::post('/register', 'App\Http\Controllers\API\AuthController@register');
Route::post('/login', 'App\Http\Controllers\API\AuthController@login');

// search filter route
Route::get('/ceo/filter', 'App\Http\Controllers\API\SearchController@filter')->middleware('auth:api');

// route for CRUD functions on CEO model
Route::apiResource('/ceo', 'App\Http\Controllers\API\CEOController')->middleware('auth:api');

// upload .csv file
Route::get('/upload', 'App\Http\Controllers\API\FileController@upload')->middleware('auth:api');

// import .csv file into database
Route::post('/import','App\Http\Controllers\API\FileController@import')->middleware('auth:api');

// download .csv file from database
Route::get('/download','App\Http\Controllers\API\FileController@download')->middleware('auth:api');