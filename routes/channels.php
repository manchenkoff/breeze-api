<?php

use App\Broadcasting\PrivateSharedChannel;
use App\Broadcasting\PrivateUserChannel;
use App\Broadcasting\PublicUserChannel;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel(PublicUserChannel::ROUTE, PublicUserChannel::class);
Broadcast::channel(PrivateUserChannel::ROUTE, PrivateUserChannel::class);
Broadcast::channel(PrivateSharedChannel::ROUTE, PrivateSharedChannel::class);
