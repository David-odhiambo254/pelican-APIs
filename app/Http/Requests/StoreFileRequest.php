<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
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
            //
            'orderId' => ['required'],
            'file' => ['required','file','max:2048'],
            'name' => [],
            'printSize' => ['required'],
            'colorMode' => ['required'],
            'copies' => ['required'],
            'status' => []
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'order_id' => $this->orderId,
            'file_path' => $this->url,
            'file_name' => $this->name,
            'print_size' => $this->printSize,
            'color_mode' => $this->colorMode,
        ]);
    }
}
