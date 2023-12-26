<?php

namespace App\Repositories;

use App\Models\Payment;

class PaymentRepository
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
