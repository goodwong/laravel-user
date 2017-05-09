<?php

namespace Goodwong\LaravelUser\Repositories;

use Goodwong\LaravelUser\Entities\User;

class UserRepository
{
    /**
     * find
     * 
     * @param  integer  $id
     * @return User
     */
    public function find($id)
    {
        return User::find($id);
    }

    /**
     * create
     * 
     * @param  array $attributes
     * @return User
     */
    public function create($attributes)
    {
        if (!isset($attributes['password'])) {
            $attributes['password'] = bcrypt(uniqid());
        }
        return User::create($attributes);
    }
}