<?php

namespace App\Services\Contracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface PaymentContract
{
    public function process(Request $request): JsonResponse;

    public function show(Request $request, $id): JsonResponse;

}
