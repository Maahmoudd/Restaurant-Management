<?php

namespace App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'reservation' => [
                'restaurant_id' => $this->restaurant_id,
                'reservation_date' => $this->reservation_date,
                'party_size' => $this->party_size,
                'user_id' => $this->user_id,
                'status' => $this->status,
            ],
            'status' => 201
        ];
    }
}
