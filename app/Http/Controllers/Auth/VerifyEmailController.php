<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

final class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        /** @var \App\Models\User */
        $user = $request->user();

        /** @var string $frontendUrl */
        $frontendUrl = config('app.frontend_url');

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(
                $frontendUrl . '/dashboard?verified=1'
            );
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->intended(
            $frontendUrl . '/dashboard?verified=1'
        );
    }
}
