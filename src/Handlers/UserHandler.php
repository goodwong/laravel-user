<?php

namespace Goodwong\LaravelUser\Handlers;

use Goodwong\LaravelUser\Events\UserCreated;
use Goodwong\LaravelUser\Entities\User;

class UserHandler
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
        if (!data_get($attributes, 'name')) {
            $attributes['name'] = '';
        }
        $user = User::create($attributes);

        event(new UserCreated($user));

        return $user;
    }
}