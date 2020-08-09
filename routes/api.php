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

Route::post('login', 'Api\AuthController@checkAuth');
Route::post('check-token', 'Api\AuthController@checkToken');
Route::post('login-qrcode', 'Api\AuthController@checkQrCode');

Route::group(['middleware' => 'hasToken'], function() {
    Route::group(['prefix' => 'posts'], function() {
        Route::get('', 'Api\PostController@index');
    });
});