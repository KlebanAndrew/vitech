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

    Route::post('/file/upload', 'Api\UserMessagesController@uploadFile');
    Route::get('/file/download/{token}', 'Api\UserMessagesController@downloadFile');
    Route::delete('/file/delete/{token}', 'Api\UserMessagesController@deleteFile');

    Route::post('/messages', 'Api\UserMessagesController@store');
    Route::post('/messages/reply', 'Api\UserMessagesController@storeReply');
    Route::get('/messages/{id}/edit', 'Api\UserMessagesController@getDraft');
    Route::post('/messages/draft', 'Api\UserMessagesController@storeDraft');
    Route::get('/messages/send', 'Api\UserMessagesController@sendList');
    Route::get('/messages/inbox', 'Api\UserMessagesController@inboxList');
    Route::get('/messages/draft', 'Api\UserMessagesController@draftList');
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
