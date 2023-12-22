<?php

namespace App\Services\Contracts;

use App\Http\Requests\PaymentRequest;
use App\Models\Payment;

interface PaymentContract
{
    public function process(PaymentRequest $request): Payment;

    public function show(PaymentRequest $request, $id): Payment;

}
