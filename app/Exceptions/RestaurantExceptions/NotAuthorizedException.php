<?php

namespace App\Exceptions\RestaurantExceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotAuthorizedException extends Exception
{
    public function report(): void
    {

    }

    public function render(Request $request): JsonResponse
    {
        return response()->json(['Error' => 'Not Authorized to access the reservation'], 400);
    }
}
