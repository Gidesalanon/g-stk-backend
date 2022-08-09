<?php

namespace App\Policies;

use App\Models\Selling;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the product can view any models.
     *
     * @param  \App\Models\Selling  $product
     * @return mixed
     */
    public function viewAny(Selling $selling)
    {
        return $selling->can('view_any selling');
    }

    /**
     * Determine whether the product can view the model.
     *
     * @param  \App\Models\Product  $product
     * @param  \App\Models\Product $model
     * @return mixed
     */
    public function view(Selling $selling, Selling $model)
    {
        return $selling->can('view sellings');
    }

    /**
     * Determine whether the product can create models.
     *
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function create(Selling $selling)
    {
        return $selling->can('create sellings');
    }

    /**
     * Determine whether the product can update the model.
     *
     * @param  \App\Models\Product  $product
     * @param  \App\Models\Product  $model
     * @return mixed
     */
    public function update(Selling $selling, Selling $model)
    {
        return $selling->can('update sellings');
    }

    /**
     * Determine whether the product can delete the model.
     *
     * @param  \App\Models\Selling  $selling
     * @param  \App\Models\Selling  $model
     * @return mixed
     */
    public function delete(Selling $selling, Selling $model)
    {
        return $selling->can('delete sellings');
    }
}
