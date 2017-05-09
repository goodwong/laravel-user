<?php

namespace Goodwong\LaravelUser\Handlers;

use Goodwong\LaravelUser\Events\UserAuthorized;
use Goodwong\LaravelUser\Entities\User;
use Illuminate\Support\Facades\Auth;

class LoginHandler
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
}