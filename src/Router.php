<?php

namespace Goodwong\LaravelUser;

use Illuminate\Support\Facades\Route;

class Router
{
    /**
     * routes
     * 
     * @return void
     */
    public static function route()
    {
        // require __DIR__.'/routes.php';
        Route::namespace('\\Goodwong\\LaravelUser\\Controllers')
        ->group(__DIR__.'/routes.php');
    }
}