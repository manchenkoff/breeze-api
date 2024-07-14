<?php

declare(strict_types=1);

namespace App\Broadcasting;

use App\Models\User;

final class PrivateUserChannel
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
