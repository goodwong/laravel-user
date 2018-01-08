<?php

namespace Goodwong\LaravelUser\Handlers;

use Goodwong\LaravelUser\Events\UserAuthorized;
use Goodwong\LaravelUser\Entities\User;
use Illuminate\Support\Facades\Auth;

class AuthHandler
{
    /**
     * login
     * 
     * @param  User  $user
     * @param  boolean  $remember_login
     * @return void
     */
    public function login($user, $remember_login = false)
    {
        Auth::login($user, $remember_login);
        event(new UserAuthorized($user));
    }

    /**
     * logout
     * 
     * @return void
     */
    public function logout()
    {
        Auth::logout();
    }
}