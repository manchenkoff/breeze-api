<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(
            function (mixed $notifiable, string $token) {
                /** @var string */
                $frontendUrl = config('app.frontend_url');

                /** @var \App\Models\User $notifiable */

                return $frontendUrl . "/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
            }
        );
    }
}
