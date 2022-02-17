<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait FilterTrait
{
    public function filterInput(&$query, $inputs)
    {
        if (empty($inputs['filters'])) {
            return $query;
        }
        foreach ($inputs['filters'] as $condition => $value) {
            $condition = Str::camel($condition);
            if(!is_null($value) && $value !== ''){
                $query = $query->$condition($value);
            }
        }
        return $query;
    }
}
