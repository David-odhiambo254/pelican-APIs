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
            'deliveryAddress' => $this->delivery_address,
            'status' => $this->status,
            'paymentMethod' => $this->payment_method,
            'deliveryDate' => $this->delivery_date,
            'total' => $this->total_price,
            'note' => $this->note
        ];
    }
}
