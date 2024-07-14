<?php

declare(strict_types=1);

namespace App\Events;

use App\Broadcasting\PrivateUserChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class PrivateMessageTriggered implements ShouldBroadcastNow
{
    const NAME = 'PrivateEvent';

    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public string $message = 'Hello private channel')
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel(PrivateUserChannel::ROUTE),
        ];
    }

    public function broadcastAs(): string
    {
        return self::NAME;
    }
}
