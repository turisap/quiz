<?php

Route::get('/test', 'TestController@index');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

// categories group
Route::group(['prefix' => 'categories'], function () {
    Route::get('/{category}', 'CategoriesController@index');
});

// authorization
Route::get('/login', 'AuthorizationController@index');
Route::post('/login', 'AuthorizationController@login');
Route::get('/signup', 'AuthorizationController@show');
Route::post('/signup', 'AuthorizationController@create');
Route::get('/logout',  'AuthorizationController@logout');

//quizes
Route::get('/myquizzes/{user}', 'QuizzesController@index');


// premiums routes
Route::group(['prefix' => 'premium'], function () {
    Route::get('/', 'PremiumsController@index');
});
