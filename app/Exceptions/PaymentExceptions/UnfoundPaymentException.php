<?php

namespace App\Exceptions\PaymentExceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UnfoundPaymentException extends Exception
{
    public function report(): void
    {

    }

    public function render(Request $request): JsonResponse
    {
        return response()->json(['Error' => 'Failed to find such Payment'], 400);
    }
}
