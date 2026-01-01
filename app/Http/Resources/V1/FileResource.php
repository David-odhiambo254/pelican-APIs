<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'orderId' => $this->order_id,
            'file' => $this->file_path,
            'name' => $this->file_name,
            'printSize' => $this->print_size,
            'colorMode' => $this->color_mode,
            'copies' => $this->copies,
            'status' => $this->status
        ];
    }
}
