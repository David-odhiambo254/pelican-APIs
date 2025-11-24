<?php
namespace App\Services;
use Illuminate\Http\Request;

class ApiFilter{
    
    // allowed paramers to filter
    protected $safeparms =[];

    // Mapping JSON fields to match database fields
    protected $columnMap = [];

    protected $operatorMap = [];

    public function transform(Request $request){
        $el0Query = [];

        foreach ($this->safeparms as $parm => $operators) {
            $query = $request->query($parm);
            
            if(!isset($query)){
                continue;
            }
            $column = $this->columnMap[$parm] ?? $parm;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $el0Query[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $el0Query;
    }
}