<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
        if($method == 'PUT'){
            return [
                'name' => ['required'],
                'email' => ['required','email'],
                'phone' => ['required'],
                'address' => ['required'],
                'status' => ['required',Rule::in(['active', 'inactive', 'suspended'])],
                'isGuest' => ['required'],
                'password' => []
            ];
        } else {
            return [
                'name' => ['sometimes','required'],
                'email' => ['sometimes','required','email'],
                'phone' => ['sometimes','required'],
                'address' => ['sometimes','required'],
                'status' => ['sometimes','required',Rule::in(['active', 'inactive', 'suspended'])],
                'isGuest' => ['sometimes','required'],
                'password' => []
            ];
        }
        
    }
    protected function prepareForValidation()
    {
        if($this->isGuest){
            $this->merge([
                'is_guest' => $this->isGuest
            ]);
        }
        
    }
}
