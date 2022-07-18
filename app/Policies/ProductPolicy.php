<?php

namespace App\Policies;

use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the product can view any models.
     *
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function viewAny(Product $product)
    {
        return $product->can('view_any products');
    }

    /**
     * Determine whether the product can view the model.
     *
     * @param  \App\Models\Product  $product
     * @param  \App\Models\Product $model
     * @return mixed
     */
    public function view(Product $product, Product $model)
    {
        return $product->can('view products');
    }

    /**
     * Determine whether the product can create models.
     *
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function create(Product $product)
    {
        return $product->can('create products');
    }

    /**
     * Determine whether the product can update the model.
     *
     * @param  \App\Models\Product  $product
     * @param  \App\Models\Product  $model
     * @return mixed
     */
    public function update(Product $product, Product $model)
    {
        return $product->can('update products');
    }

    /**
     * Determine whether the product can delete the model.
     *
     * @param  \App\Models\Product  $product
     * @param  \App\Models\Product  $model
     * @return mixed
     */
    public function delete(Product $product, Product $model)
    {
        return $product->can('delete products');
    }
}
