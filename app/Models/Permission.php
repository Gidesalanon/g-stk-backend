<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;

class Permission extends Model
{
    use HasFactory;
    use Filterable;

    private static $whiteListFilter = ['*'];
}
