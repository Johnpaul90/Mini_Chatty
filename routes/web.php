<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::group(['middleware'=>'guest'], function (){
    Route::get('/signup', [
        'uses'=> 'AuthController@getSignUp',
        'as' =>'auth.signup'
    ]);

    Route::post('/signup', [
        'uses'=> 'AuthController@postSignUp',
        'as' =>'auth.signup'
    ]);

    Route::post('/signin', [
        'uses'=> 'AuthController@postSignIn',
        'as' =>'auth.signin'
    ]);
    Route::get('/signin', [
        'uses'=> 'AuthController@getSignIn',
        'as' =>'auth.signin'
    ]);


});

Route::get('/', [
    'uses'=> 'HomeController@index',
    'as' =>'home',

]);


Route::get('/signout', [
    'uses'=> 'AuthController@getSignout',
    'as' =>'auth.signout',
    'middleware'=>'auth'
]);

Route::get('/search',[
    'uses'=>'SearchController@getResults',
    'as'=>'search.results',
    'middleware'=>'auth'
]);

Route::get('/user/{username}',[
    'uses'=>'ProfileController@getProfile',
    'as'=>'profile.index',
    'middleware'=>'auth'
]);

Route::get('/profile/edit',[
    'uses'=>'ProfileController@getEdit',
    'as'=>'profile.edit',
    'middleware'=>'auth'
]);

Route::post('/profile/edit',[
    'uses'=>'ProfileController@postEdit',
    'middleware'=>'auth'
]);
/**
 * Friends
 */

Route::get('/friends',[
    'uses'=>'FriendController@getIndex',
    'as'=>'friends.index',
    'middleware'=>'auth'
]);

Route::get('/friends/add/{username}',[
    'uses'=>'FriendController@getAddFriends',
    'as'=>'friends.add',
    'middleware'=>'auth'
]);

Route::get('/friends/accept/{username}',[
    'uses'=>'FriendController@getAcceptFriends',
    'as'=>'friends.accept',
    'middleware'=>'auth'
]);
Route::post('/friends/delete/{username}',[
    'uses'=>'FriendController@postDelete',
    'as'=>'friends.delete',
    'middleware'=>'auth'
]);
/**
 * Statuses
 */

Route::post('/status',[
    'uses'=>'StatusController@postStatus',
    'as'=>'status.post',
    'middleware'=>'auth'
]);

Route::post('/status/{statusId}/reply',[
    'uses'=>'StatusController@postReply',
    'as'=>'status.reply',
    'middleware'=>'auth'
]);

Route::get('/status/{statusId}/like',[
    'uses'=>'StatusController@getLike',
    'as'=>'status.like',
    'middleware'=>'auth'
]);
