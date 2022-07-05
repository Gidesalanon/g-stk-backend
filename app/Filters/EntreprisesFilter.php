<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait documentationFilter.
 */
trait entreprisesFilter
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

    public function website_link(Builder $builder, $value)
    {
        return $builder->where('website_link', 'like', '%'.$value.'%')
                        ->orderByDesc('website_link');
    }
    
    public function presentation(Builder $builder, $value)
    {
        return $builder->where('presentation', 'like', '%'.$value.'%')
                        ->orderByDesc('presentation');
    }
}