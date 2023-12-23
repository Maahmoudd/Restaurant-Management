<?php

namespace App\Services\Services;

use App\Exceptions\RestaurantExceptions\FullRestaurantException;
use App\Http\Requests\ReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Services\Contracts\ReservationContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use function Termwind\render;

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
        $restaurant = Restaurant::find($reservationData['restaurant_id']);

        if(!$restaurant['tables_count']) {
            throw new FullRestaurantException();
        }
        $reservation = Reservation::create($reservationData);
        $restaurant['tables_count'] = $restaurant['tables_count'] - 1;
        $restaurant->save();
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

        if ($reservation->user_id !== $request->user()->id) {
            return false;
        }

        $restaurant = Restaurant::find($reservation->restaurant_id);
        $restaurant['tables_count'] = $restaurant['tables_count'] + 1;
        $restaurant->save();

        return $reservation->delete();
    }
    public function index(Request $request): Collection
    {
        $userId = $request->user()->id;
        $reservations = Reservation::where('user_id', $userId)->get();

        return $reservations;
    }
}
