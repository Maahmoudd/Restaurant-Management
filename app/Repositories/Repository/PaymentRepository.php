<?php

namespace App\Repositories\Repository;

use App\Models\Payment;
use App\Repositories\Interfaces\PaymentRepositoryInterface;

class PaymentRepository implements PaymentRepositoryInterface
{

    public function create(array $paymentData)
    {
        return Payment::create($paymentData);
    }

    public function findById(int $id)
    {
        return Payment::findOrFail('reservation_id', $id)->first();
    }

}
