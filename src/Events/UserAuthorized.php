<?php

namespace Goodwong\LaravelUser\Events;

use Goodwong\LaravelUser\Entities\User;
use Illuminate\Queue\SerializesModels;

class UserAuthorized
{
    use SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @param  User  $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}