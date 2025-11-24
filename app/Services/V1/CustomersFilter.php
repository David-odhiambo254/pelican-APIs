<?php
namespace App\Services\V1;
use Illuminate\Http\Request;
use App\Services\ApiFilter;

class CustomersFilter extends ApiFilter{
    
    // allowed paramers to filter
    protected $safeparms =[
        'name'=> ['eq'],
        'email' => ['eq'],
        'phone' => ['eq'],
        'address' => ['eq'],
        'status' => ['eq'],
        'isGuest' => ['eq']
    ];

    // Mapping JSON fields to match database fields
    protected $columnMap = [
        'isGuest' => 'is_guest'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
        'lte' => '<=',
        'gte' => '>='
    ];

    
}