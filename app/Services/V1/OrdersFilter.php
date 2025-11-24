<?php
namespace App\Services\V1;
use Illuminate\Http\Request;
use App\Services\ApiFilter;

class OrdersFilter extends ApiFilter{
    
    // allowed paramers to filter
    protected $safeparms =[
        'customerId'=> ['eq'],
        'priority' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'deliveryAddress' => ['eq'],
        'paymentMethod' => ['eq'],
        'status' => ['eq'],
        'deliveryDate' => ['eq'],
        'total' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'note' => ['eq']
    ];

    // Mapping JSON fields to match database fields
    protected $columnMap = [
        'customerId' => 'customer_id',
        'deliveryAddress' => 'delivery_address',
        'paymentMethod' => 'payment_method',
        'deliveryDate' => 'delivery_date',
        'total' => 'total_price'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
        'lte' => '<=',
        'gte' => '>='
    ];

}