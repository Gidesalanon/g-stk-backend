<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use App\Filters\SellingsFilter;

class SellingProduct extends Model
{
    public $timestamps = true;
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    use Filterable, sellingsFilter;

    private static $whiteListFilter = ['*'];
    protected $guarded = [];

    public function sellings()
    {
        return $this->belongsTo(Selling::class, 'selling_id')->select(['id', 'description', 'selling_id']);
    }

}
