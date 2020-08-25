<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $user = new App\User();
    if ($user->hasAnyGroup(['administrator','supervisor'])) {
        return redirect('dashboard');
    } else if($user->hasAnyGroup(['user','anthusias'])) {
        return redirect('letter/form/user');
    } else {
        return redirect('login');
    }
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function() {
    Route::get('dashboard', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'user', 'middleware' => 'group:administrator'], function() {
        Route::get('', 'UserController@index');
        Route::get('form/{user?}', 'UserController@form');
        Route::post('store', 'UserController@store');
        Route::post('list', 'UserController@userList');
        Route::post('update/{id}', 'UserController@update');
        Route::post('change-password/{id}', 'UserController@changePassword');
        Route::post('status/{id}', 'UserController@status');
        Route::delete('delete/{id}', 'UserController@delete');

        Route::group(['prefix' => 'group'], function() {
            Route::post('list', 'UserController@groupList');
        });
    });

    Route::group(['prefix' => 'posts', 'middleware' => 'group:administrator,supervisor,user,anthusias'], function() {
        Route::get('', 'PostController@index');
        Route::get('form/{type}/{id?}', 'PostController@form');
        Route::post('store', 'PostController@store');
        Route::post('update/{id}', 'PostController@update');
        Route::post('status/{id}', 'PostController@status');
        Route::delete('delete/{id}', 'PostController@delete');
    });

    Route::group(['prefix' => 'oil-collector', 'middleware' => 'group:administrator,supervisor'], function() {
        Route::get('', 'OilCollectorController@index');
        Route::get('form/{type}/{id?}', 'OilCollectorController@form');
        Route::post('store', 'OilCollectorController@store');
        Route::post('update/{id}', 'OilCollectorController@update');
        Route::post('status/{id}', 'OilCollectorController@status');
        Route::delete('delete/{id}', 'OilCollectorController@delete');
    });

    Route::group(['prefix' => 'letter', 'middleware' => 'group:administrator,supervisor,user'], function() {
        Route::get('', 'LetterController@index');
        Route::get('form/{type}/{id?}', 'LetterController@form');
        Route::get('print/{id?}', 'LetterController@print');
        Route::get('validation', 'LetterController@validationView');
        Route::post('store', 'LetterController@letterValidation');
        Route::post('validation', 'LetterController@store');
        Route::post('update/{id}', 'LetterController@update');
        Route::post('status/{id}', 'LetterController@status');
        Route::delete('delete/{id}', 'LetterController@delete');
    });

    Route::group(['prefix' => 'datatable'], function() {
        Route::post('user', 'DatatableController@user');
        Route::post('posts', 'DatatableController@posts');
        Route::post('oil-collector', 'DatatableController@oilCollector');
        Route::post('letter', 'DatatableController@letter');
        Route::post('letter/user', 'DatatableController@letterUser');
    });

    Route::post('provinces', 'IndonesiaController@provinces')->name('provinces');
    Route::post('regencies', 'IndonesiaController@regencies')->name('regencies');
    Route::post('districts', 'IndonesiaController@districts')->name('districts');
    Route::post('villages', 'IndonesiaController@villages')->name('villages');
    Route::post('province', 'IndonesiaController@province')->name('province');
    Route::post('regency', 'IndonesiaController@regency')->name('regency');
    Route::post('district', 'IndonesiaController@district')->name('district');
    Route::post('village', 'IndonesiaController@village')->name('village');

    Route::post('jobs', 'HomeController@jobs')->name('jobs');
    Route::post('birthplaces', 'HomeController@birthplaces')->name('birthplaces');
    Route::post('birthplace/store', 'HomeController@storeBirthplace')->name('birthplace-store');
});
