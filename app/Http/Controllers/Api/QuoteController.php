<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Inspiring;
use Illuminate\Http\JsonResponse;

final class QuoteController extends Controller
{
    public function __invoke(): JsonResponse
    {
        /** @var string $quote */
        $quote = Inspiring::quotes()->random();
        [$text, $author] = explode(' - ', $quote);

        $data = [
            'text' => $text,
            'author' => $author,
        ];

        return response()->json($data);
    }
}
