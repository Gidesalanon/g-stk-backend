<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait documentationFilter.
 */
trait projetsFilter
{
    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param                                       $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function nom(Builder $builder, $value)
    {
        return $builder->where('nom', 'like', '%'.$value.'%')
                        ->orderByDesc('nom');
    }

    public function financeur(Builder $builder, $value)
    {
        return $builder->where('financeur', 'like', '%'.$value.'%')
                        ->orderByDesc('financeur');
    }

    public function description(Builder $builder, $value)
    {
        return $builder->where('description', 'like', '%'.$value.'%')
                        ->orderByDesc('description');
    }

    public function departement(Builder $builder, $value)
    {
        return $builder->where('departement', 'like', '%'.$value.'%')
                        ->orderByDesc('departement');
    }

    public function pole_developpement(Builder $builder, $value)
    {
        return $builder->where('pole_developpement', 'like', '%'.$value.'%')
                        ->orderByDesc('pole_developpement');
    }
}
