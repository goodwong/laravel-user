<?php

Route::group([
    'namespace' => 'Goodwong\LaravelUser\Controllers',
], function () {
    Route::get('users/me', 'AuthController@show');
    // Route::post('users/me', 'AuthController@register');
    // Route::put('users/me', 'AuthController@update');
    // Route::post('users/me/session', 'AuthController@login');
    Route::delete('users/me/session', 'AuthController@logout');

    Route::resource('users', 'UserController');
});
