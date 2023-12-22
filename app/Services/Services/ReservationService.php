<?php

namespace App\Services\Services;

use App\Http\Requests\ReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Reservation;
use App\Services\Contracts\ReservationContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ReservationService implements ReservationContract
{
    public function create(ReservationRequest $request): Reservation
    {
        $validatedData = $request->validated();
        $userId = $request->user()->id;
        $reservationData = array_merge($validatedData, [
            'user_id' => $userId,
            'status' => Reservation::STATUS_PENDING
        ]);

        $reservation = Reservation::create($reservationData);

        return $reservation;
    }

    public function update(UpdateReservationRequest $request, $id): Reservation | null
    {
        $validatedReservationUpdate = $request->validated();
        $reservation = Reservation::findOrFail($id);
        if ($reservation->user_id != $request->user()->id)
        {
            return null;
        }
        $reservation->update($validatedReservationUpdate);
        return $reservation;
    }

    public function show(Request $request, $id): Reservation
    {
        $reservation = Reservation::findOrFail($id);

        // Check if the authenticated user owns the reservation
        if ($reservation->user_id !== $request->user()->id) {
            return false;
        }

        return $reservation;
    }

    public function cancel(Request $request, $id):bool
    {
        $reservation = Reservation::findOrFail($id);

        // Check if the authenticated user owns the reservation
        if ($reservation->user_id !== $request->user()->id) {
            return false;
        }

        return $reservation->delete();
    }
    public function index(Request $request): Collection
    {
        $userId = $request->user()->id;
        $reservations = Reservation::where('user_id', $userId)->get();

        return $reservations;
    }
}
