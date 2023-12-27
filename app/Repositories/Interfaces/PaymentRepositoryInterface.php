<?php

namespace App\Repositories\Interfaces;


interface PaymentRepositoryInterface
{

    public function create(array $paymentData);

    public function findById(int $id);

}
