<?php

namespace App\Services\Services;

use App\Enums\ReservationEnum;
use App\Exceptions\PaymentExceptions\ReservationPaidException;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use App\Models\Reservation;
use App\Services\Contracts\PaymentContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentService implements PaymentContract
{
    public function process(PaymentRequest $request): Payment
    {
        $validatedData = $request->validated();
        $reservation = Reservation::findOrFail($validatedData['reservation_id']);
        if ($reservation->status === ReservationEnum::STATUS_PAID)
        {
            throw new ReservationPaidException();
        }
        $payment = Payment::create($validatedData);
        $reservation->update(['status' => ReservationEnum::STATUS_PAID]);

        return $payment;

    }

    public function show(PaymentRequest $request, $id): Payment
    {
        $payment = Payment::where('reservation_id', $id)->first();

        if ($payment)
        {
            return $payment;
        }
        else
        {
            return false;
        }
    }
}
