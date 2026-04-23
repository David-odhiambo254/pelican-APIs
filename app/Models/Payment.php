<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'payment_method',
        'amount',
        'status',
        'transaction_code',
        'phone_number',
        'card_number',
        'name_on_card',
        'expiry_date',
        'cvv'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
