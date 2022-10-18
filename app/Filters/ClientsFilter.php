<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait documentationFilter.
 */
trait clientsFilter
{
    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param                                       $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function lastname(Builder $builder, $value)
    {
        return $builder->where('lastname', 'like', '%'.$value.'%')
                        ->orderByDesc('lastname');
    }

    public function description(Builder $builder, $value)
    {
        return $builder->where('description', 'like', '%'.$value.'%')
                        ->orderByDesc('description');
    }
}