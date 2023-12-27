<?php

namespace App\Services\Services;

use App\Enums\ReservationEnum;
use App\Exceptions\PaymentExceptions\ReservationPaidException;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\ReservationRepositoryInterface;
use App\Services\Contracts\PaymentContract;
use Exception;

class PaymentService implements PaymentContract
{

    protected $paymentRepository;
    protected $reservationRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository, ReservationRepositoryInterface $reservationRepository)
    {
        $this->paymentRepository = $paymentRepository;
        $this->reservationRepository = $reservationRepository;
    }

    public function process(PaymentRequest $request): Payment
    {
        $validatedData = $request->validated();
        $reservation = $this->reservationRepository->findById($validatedData['reservation_id']);
        if ($reservation->status === ReservationEnum::STATUS_PAID)
        {
            throw new ReservationPaidException();
        }
        $payment = $this->paymentRepository->create($validatedData);
        $reservation->update(['status' => ReservationEnum::STATUS_PAID]);

        return $payment;

    }

    public function show(PaymentRequest $request, $id): Payment
    {
        $payment = $this->paymentRepository->findById($id);

        if ($payment)
        {
            return $payment;
        }
        else
        {
            throw new Exception('No Payment Record');
        }
    }
}
