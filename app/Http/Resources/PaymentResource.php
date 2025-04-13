<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'enrollment_id' => $this->enrollment_id,
            'amount' => $this->amount,
            'status' => $this->status,
            'payment_method' => $this->payment_method,
            'created_at' => $this->created_at,
        ];
    }
}