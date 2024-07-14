<?php

declare(strict_types=1);

namespace App\Broadcasting;

use App\Models\User;

final class PublicUserChannel
{
    const ROUTE = 'public';

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
