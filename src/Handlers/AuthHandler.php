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
     * @return void
     */
    public function login($user)
    {
        Auth::login($user);
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