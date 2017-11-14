<?php
//Auth routes
Auth::routes();

/**
 * Api routes
 */
Route::group([
    'prefix' => 'api',
    'middleware' => ['auth'],
], function () {
    Route::get('/contacts', 'Api\UsersController@getContacts');
    Route::post('/messages', 'Api\UserMessagesController@store');
});

//Angular app routes
Route::group([
    'middleware' => ['auth'],
], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/{one?}/{two?}/{three?}/{four?}/{five?}', function () {
        return view('welcome');
    });
});
