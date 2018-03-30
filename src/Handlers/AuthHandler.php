<?php

namespace Goodwong\User\Handlers;

use Goodwong\User\Events\UserAuthorized;
use Goodwong\User\Entities\User;
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
