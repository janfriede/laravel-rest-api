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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'App\Http\Controllers\AuthApiController@login');
    Route::post('signup', 'App\Http\Controllers\AuthApiController@signup');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'App\Http\Controllers\AuthApiController@logout');
        Route::get('user', 'App\Http\Controllers\AuthApiController@user');
    });
});

Route::group([
    'middleware' => 'auth:api'
], function() {
    Route::post('article/store', 'App\Http\Controllers\ArticleController@store');
    Route::put('article/update/{article}', 'App\Http\Controllers\ArticleController@update');
    Route::delete('article/destroy/{article}', 'App\Http\Controllers\ArticleController@destroy');
});

Route::get('articles/show/all', 'App\Http\Controllers\ArticleController@showAll');
Route::get('article/show/{id}', 'App\Http\Controllers\ArticleController@show');
