<?php

Route::group(['middleware' => 'auth'], function(){
    Route::resource('quotes', 'QuoteController', ['except' => ['index', 'show']]);
    Route::post('quotes-comment/{id}', 'QuoteCommentController@store');
    Route::put('quotes-comment/{id}', 'QuoteCommentController@update');
    Route::get('quotes-comment/{id}/edit', 'QuoteCommentController@edit');
    Route::delete('quotes-comment/{id}', 'QuoteCommentController@destroy');
    Route::get('like/{type}/{model}', 'LikeController@Like');
    Route::get('unlike/{type}/{model}', 'LikeController@Unlike');
    Route::get('notifications', 'HomeController@get_notif');
});


Route::get('/', function () { return view('welcome'); });

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/profile/{id?}', 'HomeController@profile');
Route::get('quotes/filter/{tag}', 'QuoteController@filter');
Route::get('quotes/random', 'QuoteController@random');
Route::resource('quotes', 'QuoteController', ['only' => ['index', 'show']]);
