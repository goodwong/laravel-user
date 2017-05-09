<?php

namespace Goodwong\LaravelUser\Handlers;

use Goodwong\LaravelUser\Events\UserCreated;
use Goodwong\LaravelUser\Repositories\UserRepository;

class CreateUserHandler
{
    /**
     * construct
     * 
     * @param  UserRepository  $userRepository
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * create
     * 
     * @param  array  $attributes
     * @return User
     */
    public function create($attributes)
    {
        $user = $this->userRepository->create($attributes);

        event(new UserCreated($user));

        return $user;
    }
}