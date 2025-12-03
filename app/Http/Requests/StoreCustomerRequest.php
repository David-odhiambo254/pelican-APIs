<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
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
            'name' => ['required'],
            'email' => ['required','email'],
            'phone' => ['required'],
            'address' => ['required'],
            'status' => ['required',Rule::in(['active', 'inactive', 'suspended'])],
            'isGuest' => ['required'],
            'password' => []
        ];
    }

    // Merging client & database columns
    protected function prepareForValidation()
    {
        // return parent::prepareForValidation();

        $this->merge([
            'is_guest' => $this->isGuest
        ]);
    }
}
