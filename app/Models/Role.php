<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;


class Role extends \Spatie\Permission\Models\Role
{

    public $timestamps = true;
    public $incrementing = false;
    protected $keyType = 'string';
    const SUPERADMIN = 'root';
    const ADMIN = 'admin';
    const DATA_MANAGER = 'data_manager';
    const MODERATOR='moderator';

    use Filterable;

    private static $whiteListFilter = ['*'];
    /**
     * Set role's display_name
     *
     * @param $value
     * @return void
     */
    public function setDisplayNameAttribute($value)
    {
        $this->attributes['display_name'] = ucfirst($value);
    }

    public function scopeOf(Builder $query, $roleName)
    {
        return $query->where('name', $roleName);
    }

}

