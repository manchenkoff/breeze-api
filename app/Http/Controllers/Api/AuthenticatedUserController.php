<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

final class AuthenticatedUserController extends Controller
{
    public function __invoke(Request $request): ?User
    {
        return $request->user();
    }
}
