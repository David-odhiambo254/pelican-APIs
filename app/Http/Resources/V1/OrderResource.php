<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customerId' => $this->customer_id,
            'priority' => $this->priority,
            'delivery_address' => $this->delivery_address,
            'status' => $this->status,
            'payment_method' => $this->payment_method,
            'delivery_date' => $this->delivery_date,
            'total' => $this->total_price,
            'note' => $this->note
        ];
    }
}
