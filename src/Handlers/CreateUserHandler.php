<?php

namespace Goodwong\LaravelUser\Handlers;

use Goodwong\LaravelUser\Events\UserCreated;
use Goodwong\LaravelUser\Entities\User;

class CreateUserHandler
{
    /**
     * construct
     * 
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * create
     * 
     * @param  array  $attributes
     * @return User
     */
    public function create($attributes)
    {
        if (!isset($attributes['password'])) {
            $attributes['password'] = bcrypt(uniqid());
        }
        $user = User::create($attributes);

        event(new UserCreated($user));

        return $user;
    }
}