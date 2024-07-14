<?php

declare(strict_types=1);

namespace App\Events;

use App\Broadcasting\PublicUserChannel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class PublicMessageTriggered implements ShouldBroadcastNow
{
    const NAME = 'PublicEvent';

    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public string $message = 'Hello public channel')
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
            new Channel(PublicUserChannel::ROUTE),
        ];
    }

    public function broadcastAs(): string
    {
        return self::NAME;
    }
}
