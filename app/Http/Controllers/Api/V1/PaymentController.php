<?php

namespace App\Http\Controllers\Api\V1;

// use App\Models\Payment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Resources\V1\PaymentResource;
use App\Models\Order;
// use Illuminate\Http\Request;

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
        //return new StorePaymentRequest(Payment::create($request->all()));
        // return new PaymentResource(Payment::create($request->all()));

        // This is where you would integrate with a payment gateway to process the payment, get the transaction code, and update the payment status accordingly. For now, we'll just create a payment record with a pending status.
        if ($request->payment_method === 'mpesa_paybill' || $request->payment_method === 'bank') {
            // Validate transaction code for M-Pesa Paybill
            $request->validate([
                'transaction_code' => 'required|string|unique:payments,transaction_code',
            ]);
        }
        if ($request->payment_method === 'mpesa_stk' || $request->payment_method === 'airtel') {
            // Validate phone number for M-Pesa STK Push
            $request->validate([
                'phone_number' => 'required|digits:10',
            ]);
        }
        if ($request->payment_method === 'card') {
            // Validate card details
            $request->validate([
                'card_number' => 'required|digits:16',
                'name_on_card' => 'required|string',
                'expiry_date' => 'required|date_format:m/y|after:today',
                'cvv' => 'required|digits:3',
            ]);
        }
        $Order = Order::find($request->order_id);
        if ($Order) {
            $Order->update(['payment_method' => $request->payment_method,'status' => 'paid']);

            $Order->payment()->create($request->all()); //$Order->payment()->updateOrCreate($request->all());
            return new PaymentResource($Order->payment);
        } else {
            return response()->json([
                'message' => 'Cannot make payment without order',
            ], 404);
        }
        
    }
}
