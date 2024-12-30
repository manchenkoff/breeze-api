<?php

declare(strict_types=1);

use App\Http\Controllers\Api\AuthenticatedUserController;
use App\Http\Controllers\Api\TokenAuthenticationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', AuthenticatedUserController::class);

Route::middleware(['guest'])->post('/login', [TokenAuthenticationController::class, 'store']);
Route::middleware(['auth:sanctum'])->post('/logout', [TokenAuthenticationController::class, 'destroy']);
