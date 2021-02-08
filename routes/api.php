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

Route::prefix('upload')->name('upload.')->group(function(){
    Route::post('image','ImagesController@store')->name('image');
});


Route::prefix('index')->namespace('Index')->name('index.')->group(function(){
    Route::get('config','ConfigController@info');
});

Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function(){

    Route::prefix('login')->name('login.')->group(function(){
        Route::post('','AuthController@login')->name('login');
        Route::get('','AuthController@userInfo')->name('user_info');
        Route::delete('','AuthController@destroy')->name('logout');
//        Route::put('','AuthController')->name('refresh');
//        Route::delete('','AuthController')->name('logout');
    });


    Route::get('home','Admin\HomeController@index')->name('index');
});
