<?php

namespace App\Services\Contracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface ReservationContract
{
    public function create(Request $request): JsonResponse;

    public function update(Request $request, $id): JsonResponse;

    public function show(Request $request, $id): JsonResponse;

    public function cancel(Request $request, $id): JsonResponse;

    public function index(Request $request):JsonResponse;
}
