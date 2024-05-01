<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended('/dashboard');
        }

        $user->sendEmailVerificationNotification();

        return response()->json(['status' => 'verification-link-sent']);
    }
}
