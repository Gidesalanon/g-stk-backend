<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Projet;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjetPolicy
{
    use HandlesAuthorization;

   /**
     * Determine whether the projet can view any models.
     *
     * @param  \App\Models\Projet  $projet
     * @return mixed
     */
    public function viewAny(Projet $projet)
    {
        return $projet->can('view_any projets');
    }

    /**
     * Determine whether the projet can view the model.
     *
     * @param  \App\Models\Projet  $projet
     * @param  \App\Models\Projet $model
     * @return mixed
     */
    public function view(Projet $projet, Projet $model)
    {
        return $projet->can('view projets');
    }

    /**
     * Determine whether the projet can create models.
     *
     * @param  \App\Models\Projet  $projet
     * @return mixed
     */
    public function create(Projet $projet)
    {
        return $projet->can('create projets');
    }

    /**
     * Determine whether the projet can update the model.
     *
     * @param  \App\Models\Projet  $projet
     * @param  \App\Models\Projet  $model
     * @return mixed
     */
    public function update(Projet $projet, Projet $model)
    {
        return $projet->can('update projets');
    }

    /**
     * Determine whether the projet can delete the model.
     *
     * @param  \App\Models\Projet  $projet
     * @param  \App\Models\Projet  $model
     * @return mixed
     */
    public function delete(Projet $projet, Projet $model)
    {
        return $projet->can('delete projets');
    }
}
