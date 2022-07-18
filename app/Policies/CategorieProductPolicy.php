<?php

namespace App\Policies;

use App\Models\CategorieProduct;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategorieProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the categorieProduct can view any models.
     *
     * @param  \App\Models\CategorieProduct  $categorieProduct
     * @return mixed
     */
    public function viewAny(CategorieProduct $categorieProduct)
    {
        return $categorieProduct->can('view_any categorieProducts');
    }

    /**
     * Determine whether the categorieProduct can view the model.
     *
     * @param  \App\Models\CategorieProduct  $categorieProduct
     * @param  \App\Models\CategorieProduct $model
     * @return mixed
     */
    public function view(CategorieProduct $categorieProduct, CategorieProduct $model)
    {
        return $categorieProduct->can('view categorieProducts');
    }

    /**
     * Determine whether the categorieProduct can create models.
     *
     * @param  \App\Models\CategorieProduct  $categorieProduct
     * @return mixed
     */
    public function create(CategorieProduct $categorieProduct)
    {
        return $categorieProduct->can('create categorieProducts');
    }

    /**
     * Determine whether the categorieProduct can update the model.
     *
     * @param  \App\Models\CategorieProduct  $categorieProduct
     * @param  \App\Models\CategorieProduct  $model
     * @return mixed
     */
    public function update(CategorieProduct $categorieProduct, CategorieProduct $model)
    {
        return $categorieProduct->can('update categorieProducts');
    }

    /**
     * Determine whether the categorieProduct can delete the model.
     *
     * @param  \App\Models\CategorieProduct  $categorieProduct
     * @param  \App\Models\CategorieProduct  $model
     * @return mixed
     */
    public function delete(CategorieProduct $categorieProduct, CategorieProduct $model)
    {
        return $categorieProduct->can('delete categorieProducts');
    }
}
