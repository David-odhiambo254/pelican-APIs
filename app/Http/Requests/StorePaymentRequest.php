<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'orderId' => ['required'],
            'amount' => ['required'],
            'paymentMethod' => ['required'],
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'order_id' => $this->orderId,
            'payment_method' => $this->paymentMethod,
        ]);
    }
}
