<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', 'FlyersController@index');
	Route::resource('flyers', 'FlyersController');	
    Route::get('{zip}/{street}', 'FlyersController@show');
    Route::post('{zip}/{street}/photos', ['as' =>'store_photo_path', 'uses' => 'FlyersController@addPhotos']);
});
