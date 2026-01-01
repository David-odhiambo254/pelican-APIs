<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulkStoreFileRequest extends FormRequest
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
            '*.orderId' => ['required'], //  'data.*.orderId' => ['required']
            '*.url' => ['required'],
            '*.name' => ['required'],
            '*.printSize' => ['required'],
            '*.colorMode' => ['required'],
            '*.copies' => ['required'],
            '*.status' => []
        ];
    }
    protected function prepareForValidation()
    {
        $data = [];

        foreach ($this->toArray() as $obj) {
            $obj['order_id'] = $obj['orderId'] ?? null;
            $obj['file_path'] = $obj['file'] ?? null;
            $obj['file_name'] = $obj['name'] ?? null;
            $obj['print_size'] = $obj['printSize'] ?? null;
            $obj['color_mode'] = $obj['colorMode'] ?? null;

            $data[] = $obj;
        }
        $this->merge($data);


        // $this->merge([
        //     'order_id' => $this->orderId,
        //     'file_path' => $this->url,
        //     'file_name' => $this->name,
        //     'print_size' => $this->printSize,
        //     'color_mode' => $this->colorMode,
        // ]);
    }
}
