<?php

namespace App\Traits;

trait Searchable
{
    function search($query, array $searchableFields)
    {
        if (request()->has('search')) {
            return $query->where(function ($subquery) use ($searchableFields) {
                foreach ($searchableFields as $field) {
                    $subquery->orwhere($field, 'like', '%' . request('search') . '%');
                }
            });
        }
        return ;
    }
}
