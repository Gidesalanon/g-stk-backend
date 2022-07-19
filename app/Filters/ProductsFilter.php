<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait documentationFilter.
 */
trait productsFilter
{
    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param                                       $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function name(Builder $builder, $value)
    {
        return $builder->where('name', 'like', '%'.$value.'%')
                        ->orderByDesc('name');
    }

    public function expiration_date(Builder $builder, $value)
    {
        return $builder->where('expiration_date', 'like', '%'.$value.'%')
                        ->orderByDesc('expiration_date');
    }

    public function quantity(Builder $builder, $value)
    {
        return $builder->where('quantity', 'like', '%'.$value.'%')
                        ->orderByDesc('quantity');
    }

    public function description(Builder $builder, $value)
    {
        return $builder->where('description', 'like', '%'.$value.'%')
                        ->orderByDesc('description');
    }
    
}