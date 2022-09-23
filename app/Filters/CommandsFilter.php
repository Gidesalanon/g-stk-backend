<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait documentationFilter.
 */
trait commandsFilter
{
    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param                                       $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function qty(Builder $builder, $value)
    {
        return $builder->where('qty', 'like', '%'.$value.'%')
                        ->orderByDesc('qty');
    }

    public function description(Builder $builder, $value)
    {
        return $builder->where('description', 'like', '%'.$value.'%')
                        ->orderByDesc('description');
    }
    
    public function product_id(Builder $builder, $value)
    {
        return $builder->where('product_id', 'like', '%'.$value.'%')
                        ->orderByDesc('product_id');
    }
    
    public function user_id(Builder $builder, $value)
    {
        return $builder->where('user_id', 'like', '%'.$value.'%')
                        ->orderByDesc('user_id');
    }
}