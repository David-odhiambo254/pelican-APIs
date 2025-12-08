<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
        $method = $this->method();
        if($method =='PUT'){
            return [
                'customerId' => ['required'],
                'priority' => ['required'],
                'deliveryAddress' => ['required'],
                'status' => ['required'],
                'paymentMethod' => ['required'],
                'deliveryDate' => ['required'],
                'total' => ['required'],
                'note' => []
            ];
        } else{
            return[
                'customerId' => ['sometimes','required'],
                'priority' => ['sometimes','required'],
                'deliveryAddress' => ['sometimes','required'],
                'status' => ['sometimes','required'],
                'paymentMethod' => ['sometimes','required'],
                'deliveryDate' => ['sometimes','required'],
                'total' => ['sometimes','required'],
                'note' => ['sometimes']
            ];
        }
        
    }

    protected function prepareForValidation()
    {
        // if($this->customerId){
        //     $this->merge([
        //         'customer_id' => $this-> customerId
        //     ]);
        // }

        $this-> customerId ? $this->merge(['customer_id' => $this-> customerId]) : '';
        $this-> deliveryAddress ? $this->merge(['delivery_address' => $this-> deliveryAddress]) : '';
        $this-> paymentMethod ? $this->merge(['payment_method' => $this-> paymentMethod]) : '';
        $this-> deliveryDate ? $this->merge(['delivery_date' => $this-> deliveryDate]) : '';
        $this-> total ? $this->merge(['total_price' => $this-> total]) : '';
        
        // $this->merge([
        //     'customer_id' => $this-> customerId,
        //     'delivery_address' => $this-> deliveryAddress,
        //     'payment_method' => $this-> paymentMethod,
        //     'delivery_date' => $this-> deliveryDate,
        //     'total_price' => $this-> total
        // ]);
    }
}
