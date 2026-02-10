<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class imageDescription extends Model
{
    protected $fillable = [
        'user_id',
        'description',
        'image_path',
        'original_filename',
        'file_size',
        'mime_type'
    ];

    public function user()
    {
        return $this->belongsTo(Customer::class);
    }
}
