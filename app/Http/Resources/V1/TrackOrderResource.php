<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrackOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'customerId' => $this->customer_id,
            'priority' => $this->priority,
            'deliveryAddress' => $this->delivery_address,
            'status' => $this->status,
            
        ];
    }
}
