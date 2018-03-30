<?php

namespace Goodwong\User;

use Illuminate\Support\Facades\Route;

class Router
{
    /**
     * auth routes
     * 
     * @return void
     */
    public static function auth()
    {
        Route::group([
            'namespace' => 'Goodwong\User\Controllers',
        ], function () {
            Route::get('users/me', 'AuthController@show');
            // Route::post('users/me', 'AuthController@register');
            // Route::put('users/me', 'AuthController@update');
            // Route::post('users/me/session', 'AuthController@login');
            Route::delete('users/me/session', 'AuthController@logout');
        });
    }

    /**
     * resource routes
     * 
     * @return void
     */
    public static function resource()
    {
        Route::group([
            'namespace' => 'Goodwong\User\Controllers',
        ], function () {
            Route::resource('users', 'UserController');
        });
    }
}
