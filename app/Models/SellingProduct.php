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

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id')->select(['id', 'description', 'product_id']);
    }

    public function delete($removeFile = true)
    {
        // if ($removeFile) {
        //     $this->fichier->delete();
        // }

        return parent::delete();
    }

    public function fichier()
    {
        return $this->belongsTo(Fichier::class, 'fichier_id')->select(['id', 'filename']);;
    }
}
