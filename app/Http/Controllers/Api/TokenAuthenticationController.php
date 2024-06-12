<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

final class TokenAuthenticationController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::whereEmail($request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        /** @var string */
        $userPassword = $user->password;
        $requestPassword = $request->string('password')->toString();

        if (!Hash::check($requestPassword, $userPassword)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $response = [
            'token' => $user->createToken('web')->plainTextToken,
        ];

        return response()->json($response);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        /** @var User */
        $user = $request->user();
        /** @var PersonalAccessToken */
        $token = $user->currentAccessToken();

        $token->delete();

        return response()->noContent();
    }
}
