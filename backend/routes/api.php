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

Route::post('login', 'Api\AuthController@login');
Route::post('check-token', 'Api\AuthController@checkToken');
Route::post('login-qrcode', 'Api\AuthController@checkQrCode');

Route::group(['middleware' => 'hasUser'], function () {
    Route::post('logout', 'Api\AuthController@logout');
    Route::group(['prefix' => 'posts'], function () {
        Route::post('', 'Api\PostController@index');
    });
});
