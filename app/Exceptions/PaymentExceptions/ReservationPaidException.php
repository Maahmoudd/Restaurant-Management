<?php

namespace App\Exceptions\PaymentExceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReservationPaidException extends Exception
{
    public function report(): void
    {

    }

    public function render(Request $request): JsonResponse
    {
        return response()->json(['Error' => 'Reservation Paid Once'], 400);
    }
}
