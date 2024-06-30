<?php

namespace App\Broadcasting;

use App\Models\User;

class PrivateUserChannel
{
    const ROUTE = 'users.{id}';

    /**
     * Create a new channel instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join(User $user, int $id): array|bool
    {
        return (int) $user->id === (int) $id;
    }
}
