<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait documentationFilter.
 */
trait usersFilter
{
    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param                                       $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function username(Builder $builder, $value)
    {
        return $builder->where('username', 'like', '%'.$value.'%')
                        ->orderByDesc('username');
    }

    public function email(Builder $builder, $value)
    {
        return $builder->where('email', 'like', '%'.$value.'%')
                        ->orderByDesc('email');
    }
    
    public function firstname(Builder $builder, $value)
    {
        return $builder->where('firstname', 'like', '%'.$value.'%')
                        ->orderByDesc('firstname');
    }
    
    public function lastname(Builder $builder, $value)
    {
        return $builder->where('lastname', 'like', '%'.$value.'%')
                        ->orderByDesc('lastname');
    }
}