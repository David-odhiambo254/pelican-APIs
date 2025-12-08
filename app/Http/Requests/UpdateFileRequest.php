<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFileRequest extends FormRequest
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
            'orderId' => ['required'],
            'url' => ['required'],
            'name' => ['required'],
            'printSize' => ['required'],
            'colorMode' => ['required'],
            'copies' => ['required'],
            'status' => []
           ];
        }else{
            return[
                'orderId' => ['sometimes','required'],
                'url' => ['sometimes','required'],
                'name' => ['sometimes','required'],
                'printSize' => ['sometimes','required'],
                'colorMode' => ['sometimes','required'],
                'copies' => ['sometimes','required'],
                'status' => []
            ];
        }
        
    }
    protected function prepareForValidation()
    {
        $this->orderId ? $this->merge(['order_id' => $this->orderId]) : '';
        $this->url ? $this->merge(['file_path' => $this->url]) : '';
        $this->name ? $this->merge(['file_name' => $this->name]) : '';
        $this->printSize ? $this->merge(['print_size' => $this->printSize]) : '';
        $this->colorMode ? $this->merge(['color_mode' => $this->colorMode]) : '';
        
        // $this->merge([
        //     'order_id' => $this->orderId,
        //     'file_path' => $this->url,
        //     'file_name' => $this->name,
        //     'print_size' => $this->printSize,
        //     'color_mode' => $this->colorMode,
        // ]);
    }
}
