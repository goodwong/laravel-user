<?php

Route::get('users/me', 'AuthController@show');
Route::post('users/me', 'AuthController@login');
Route::delete('users/me', 'AuthController@logout');