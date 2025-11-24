<?php
namespace App\Services\V1;
use Illuminate\Http\Request;
use App\Services\ApiFilter;

class FilesFilter extends ApiFilter{
    
    // allowed paramers to filter
    protected $safeparms =[
        'orderId'=> ['eq'],
        'filePath' => ['eq'],
        'fileName' => ['eq'],
        'printSize' => ['eq'],
        'status' => ['eq'],
        'colorMode' => ['eq']
    ];

    // Mapping JSON fields to match database fields
    protected $columnMap = [
        'orderId' => 'order_id',
        'filePath' => 'file_path',
        'fileName' => 'file_name',
        'printSize' => 'print_size',
        'colorMode' => 'color_mode'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
        'lte' => '<=',
        'gte' => '>='
    ];

   
}