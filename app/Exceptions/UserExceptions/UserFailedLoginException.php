<?php

namespace App\Exceptions\UserExceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserFailedLoginException extends Exception
{
    public function render(Request $request): JsonResponse
    {
        return response()->json(['Error' => 'Failed Login'], 400);
    }
}
