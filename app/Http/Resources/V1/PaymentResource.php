<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'orderId' => $this->order_id,
            'amount' => $this->amount,
            'paymentMethod' => $this->payment_method,
            'transactionCode' => $this->transaction_code,
            'phoneNumber' => $this->phone_number,
            'cardNumber' => $this->card_number,
            'nameOnCard' => $this->name_on_card,
            'expiryDate' => $this->expiry_date,
            'cvv' => $this->cvv,
        ];
    }
}
