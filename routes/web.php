<?php

Route::get('/test', 'TestController@index');
Route::get('/p', 'PaymentsController@details');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

// categories group
Route::group(['prefix' => 'categories'], function () {
    Route::get('/{category}', 'CategoriesController@index');
});

// authorization
Route::get('/login', 'AuthorizationController@index');
Route::post('/login', 'AuthorizationController@login')->name('login');
Route::get('/signup', 'AuthorizationController@show');
Route::post('/signup', 'AuthorizationController@create');
Route::get('/logout',  'AuthorizationController@logout');
// facebook
Route::get('login/facebook', 'FacebookController@redirectToProvider');
Route::get('login/facebook/callback', 'FacebookController@handleProviderCallback');

//quizes
Route::get('/myquizzes/{user}', 'QuizzesController@index');
Route::get('/quizzes/like/{quiz}', 'QuizzesController@like');
Route::get('/quizzes/unlike/{quiz}', 'QuizzesController@unlike');
Route::get('/quizzes/delete/{quiz}', 'QuizzesController@delete');
Route::resource('author', 'TeachersController');
Route::get('/remove-question/{question}', 'TeachersController@deleteQuestion');

//Play a Quiz
Route::get('/quizzes/play/{quiz}', 'QuestionsController@play');
Route::get('/quizzes/ajax/{quiz}', 'QuestionsController@getAjax');


// premiums routes
Route::group(['prefix' => 'premium'], function () {
    Route::get('/', 'PremiumsController@index')->name('premium');
    Route::get('/checkout', 'PaymentsController@checkout');
    Route::get('/paid', 'PaymentsController@execute');
});

// profile routes
Route::resource('profile', 'ProfilesController');

// admin routes
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@index');
    Route::get('/grant-teacher/{user}', 'AdminController@grantTeacherStatus');
    Route::get('/grant-admin/{user}', 'AdminController@grantAdminStatus');
    Route::get('/delete-user/{user}', 'AdminController@deleteUser');
});

