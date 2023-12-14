<?php

namespace App\Services\Services;

use App\Models\Reservation;
use App\Services\Contracts\ReservationContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReservationService implements ReservationContract
{
    public function create(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'reservation_date' => 'required',
            'party_size' => 'required|integer|min:1',
        ]);

        // Fetch authenticated user's ID
        $userId = $request->user()->id;

        $reservationData = array_merge($validatedData, [
            'user_id' => $userId,
            'status' => Reservation::STATUS_PENDING
        ]);

        $reservation = Reservation::create($reservationData);

        return response()->json(['message' => 'Reservation created successfully', 'reservation' => $reservation], 201);
    }

    public function update(Request $request, $id):JsonResponse
    {
        $reservation = Reservation::findOrFail($id);

        // Check if the authenticated user owns the reservation
        if ($reservation->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized. You do not have permission to update this reservation.'], 403);
        }

        $validatedData = $request->validate([
            'reservation_date' => 'required|date',
            'party_size' => 'required|integer|min:1',
            // Additional validation as needed
        ]);

        $reservation->update($validatedData);

        return response()->json(['message' => 'Reservation updated successfully', 'reservation' => $reservation]);
    }

    public function show(Request $request, $id):JsonResponse
    {
        $reservation = Reservation::findOrFail($id);

        // Check if the authenticated user owns the reservation
        if ($reservation->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized. You do not have permission to view this reservation.'], 403);
        }

        return response()->json(['reservation' => $reservation]);
    }

    public function cancel(Request $request, $id):JsonResponse
    {
        $reservation = Reservation::findOrFail($id);

        // Check if the authenticated user owns the reservation
        if ($reservation->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized. You do not have permission to cancel this reservation.'], 403);
        }

        $reservation->delete();

        return response()->json(['message' => 'Reservation canceled successfully']);
    }
    public function index(Request $request):JsonResponse
    {
        $userId = $request->user()->id;
        $reservations = Reservation::where('user_id', $userId)->get();

        return response()->json(['reservations' => $reservations]);
    }
}
