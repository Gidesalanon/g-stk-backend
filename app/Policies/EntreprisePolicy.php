<?php

namespace App\Policies;

use App\Models\Entreprise;
use Illuminate\Auth\Access\HandlesAuthorization;

class EntreprisePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the entreprise can view any models.
     *
     * @param  \App\Models\Entreprise  $entreprise
     * @return mixed
     */
    public function viewAny(Entreprise $entreprise)
    {
        return $entreprise->can('view_any entreprises');
    }

    /**
     * Determine whether the entreprise can view the model.
     *
     * @param  \App\Models\Entreprise  $entreprise
     * @param  \App\Models\Entreprise $model
     * @return mixed
     */
    public function view(Entreprise $entreprise, Entreprise $model)
    {
        return $entreprise->can('view entreprises');
    }

    /**
     * Determine whether the entreprise can create models.
     *
     * @param  \App\Models\Entreprise  $entreprise
     * @return mixed
     */
    public function create(Entreprise $entreprise)
    {
        return $entreprise->can('create entreprises');
    }

    /**
     * Determine whether the entreprise can update the model.
     *
     * @param  \App\Models\Entreprise  $entreprise
     * @param  \App\Models\Entreprise  $model
     * @return mixed
     */
    public function update(Entreprise $entreprise, Entreprise $model)
    {
        return $entreprise->can('update entreprises');
    }

    /**
     * Determine whether the entreprise can delete the model.
     *
     * @param  \App\Models\Entreprise  $entreprise
     * @param  \App\Models\Entreprise  $model
     * @return mixed
     */
    public function delete(Entreprise $entreprise, Entreprise $model)
    {
        return $entreprise->can('delete entreprises');
    }
}
