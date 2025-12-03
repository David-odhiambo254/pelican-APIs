<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /** @use HasFactory<\Database\Factories\FileFactory> */
    use HasFactory;

    protected $fillable = [
        'order_id' ,
        'file_path' ,
        'file_name' ,
        'print_size' ,
        'color_mode' ,
        'copies' ,
        'status'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
