<?php

namespace App\Http\Controllers\Api;

use App\Events\PrivateMessageTriggered;
use App\Events\PrivateSharedMessageTriggered;
use App\Events\PublicMessageTriggered;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class TriggerEventsController extends Controller
{
    public function __invoke(string $type): JsonResponse
    {
        switch ($type) {
            case 'public':
                broadcast(new PublicMessageTriggered());
                break;
            case 'private':
                $user = auth()->user();

                if (!$user) {
                    return response()->json(['message' => 'Unauthorized'], 401);
                }

                broadcast(new PrivateMessageTriggered($user));
                broadcast(new PrivateSharedMessageTriggered());
                break;
            default:
                return response()->json(['message' => 'Invalid event type'], 400);
        }

        return response()->json(['message' => 'Event triggered']);
    }
}
