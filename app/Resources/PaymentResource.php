<?php

namespace App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'Payment' => [
                'reservation_id' => $this->reservation_id,
                'amount' => $this->amount,
                'id' => $this->id,
            ],
            'status' => 201
        ];
    }
}
