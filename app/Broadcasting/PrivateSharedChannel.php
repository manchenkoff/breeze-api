<?php

namespace App\Broadcasting;

use App\Models\User;

class PrivateSharedChannel
{
    const ROUTE = 'users';

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
    public function join(User $user): bool
    {
        return true;
    }
}
