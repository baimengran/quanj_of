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
    Route::prefix('config')->name('config.')->group(function() {
        Route::get('info', 'ConfigController@info')->name('info');
    });
    Route::prefix('home')->name('home.')->group(function() {
        Route::get('index', 'HomeController@index')->name('index');
    });
});

Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function(){

    Route::prefix('login')->name('login.')->group(function(){
        Route::post('','AuthController@login')->name('login');
        Route::get('','AuthController@userInfo')->name('user_info');
        Route::delete('','AuthController@destroy')->name('logout');
//        Route::put('','AuthController')->name('refresh');
//        Route::delete('','AuthController')->name('logout');
    });

    Route::prefix('category')->name('category.')->group(function(){
        Route::get('categoryList','CategoryController@categoryList')->name('categoryList');
        Route::post('categoryCreate','CategoryController@categoryCreate')->name('categoryCreate');
        Route::post('categoryUpdate','CategoryController@categoryUpdate')->name('categoryUpdate');
        Route::get('categoryDetail','CategoryController@categoryDetail')->name('categoryDetail');
        Route::get('categoryDel','CategoryController@categoryDel')->name('categoryDel');
    });

    Route::prefix('template')->name('template.')->group(function (){
        Route::get('templateList','TemplateController@templateList')->name('templateList');
        Route::get('templateDetail','TemplateController@templateDetail')->name('templateDetail');
        Route::post('templateCreate','TemplateController@templateCreate')->name('templateCreate');
        Route::post('templateUpdate','TemplateController@templateUpdate')->name('templateUpdate');
        Route::get('templateDel','TemplateController@templateDel')->name('templateDel');
    });

    Route::prefix('issue')->name('issue.')->group(function (){
        Route::get('issueList','IssueController@issueList')->name('issueList');
        Route::get('issueDetail','IssueController@issueDetail')->name('issueDetail');
        Route::post('issueCreate','IssueController@issueCreate')->name('issueCreate');
        Route::post('issueUpdate','IssueController@issueUpdate')->name('issueUpdate');
        Route::get('issue','IssueController@issue')->name('issue');
        Route::get('issueDel','IssueController@issueDel')->name('issueDel');
    });

    Route::prefix('field')->name('field.')->group(function (){
        Route::get('fieldList','FieldController@fieldList')->name('fieldList');
        Route::get('fieldDetail','FieldController@fieldDetail')->name('fieldDetail');
        Route::post('fieldCreate','FieldController@fieldCreate')->name('fieldCreate');
        Route::post('fieldUpdate','FieldController@fieldUpdate')->name('fieldUpdate');
        Route::get('fieldDel','FieldController@fieldDel')->name('fieldDel');
    });

    Route::prefix('cate')->name('cate.')->group(function(){
        Route::get('cateList','CateController@cateList')->name('cateList');
        Route::get('cateDetail','CateController@cateDetail')->name('cateDetail');
        Route::post('cateCreate','CateController@cateCreate')->name('cateCreate');
        Route::post('cateUpdate','CateController@cateUpdate')->name('cateUpdate');
        Route::get('cateDel','CateController@cateDel')->name('cateDel');
    });

    Route::prefix('config')->name('config.')->group(function(){
        Route::get('configList','ConfigController@configList')->name('configList');
        Route::get('configDetail','ConfigController@configDetail')->name('configDetail');
        Route::post('configUpdate','ConfigController@configUpdate')->name('configUpdate');
        Route::post('configCreate','ConfigController@configCreate')->name('configCreate');
        Route::get('configDel','ConfigController@configDel')->name('configDel');
    });

    Route::prefix('images')->name('images.')->group(function(){
        Route::post('store','ImagesController@store')->name('store');
    });

    Route::prefix('feedback')->name('feedback.')->group(function(){
        Route::get('feedbackList','FeedbackController@feedbackList')->name('feedbackList');
    });

});
