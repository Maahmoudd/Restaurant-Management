<?php

namespace App\Services\Services;

use App\Enums\ReservationEnum;
use App\Models\Payment;
use App\Models\Reservation;
use App\Services\Contracts\PaymentContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentService implements PaymentContract
{
    public function process(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'amount' => 'required|numeric|min:0',
        ]);

        $reservation = Reservation::findOrFail($validatedData['reservation_id']);
        if ($reservation->status === ReservationEnum::STATUS_PAID) {
            return response()->json(['message' => 'Reservation has already been paid'], 400);
        }
        $payment = Payment::create($validatedData);

        $reservation->update(['status' => ReservationEnum::STATUS_PAID]);

        return response()->json(['message' => 'Payment processed successfully', 'payment' => $payment], 201);

    }

    public function show(Request $request, $id): JsonResponse
    {
        $payment = Payment::where('reservation_id', $id)->first();

        if ($payment) {
            return response()->json(['payment' => $payment]);
        } else {
            return response()->json(['message' => 'Payment details not found'], 404);
        }
    }
}
