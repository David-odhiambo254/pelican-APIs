<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Payment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Resources\V1\PaymentResource;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // public function create(Request $request)
    // {
    //     // Validate the request data
    //     $validatedData = $request->validate([
    //         'order_id' => 'required|exists:orders,id',
    //         'amount' => 'required|numeric',
    //         'payment_method' => 'required|string',
    //     ]);

    //     // Create a new payment record
    //     $payment = Payment::create([
    //         'order_id' => $validatedData['order_id'],
    //         'amount' => $validatedData['amount'],
    //         'payment_method' => $validatedData['payment_method'],
    //         'status' => 'pending', // You can set the initial status as needed
    //     ]);

    //     // Return a response with the created payment
    //     return response()->json([
    //         'message' => 'Payment created successfully',
    //         'payment' => $payment,
    //     ], 201);
    // }

    public function store(StorePaymentRequest $request)
    {
        // This is where you would integrate with a payment gateway to process the payment, get the transaction code, and update the payment status accordingly. For now, we'll just create a payment record with a pending status.
        $Order = Order::find($request->order_id);
        if ($Order) {
            $Order->payment()->create($request->all());
            return new PaymentResource($Order->payment);
        } else {
            return response()->json([
                'message' => 'Cannot make payment without order',
            ], 404);
        }
        
    }
}
