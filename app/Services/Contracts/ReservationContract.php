<?php

namespace App\Services\Contracts;

use App\Http\Requests\ReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface ReservationContract
{
    public function create(ReservationRequest $request): Reservation;

    public function update(UpdateReservationRequest $request, $id): Reservation | null;

    public function show(Request $request, $id): Reservation;

    public function cancel(Request $request, $id): bool;

    public function index(Request $request):Collection;
}
