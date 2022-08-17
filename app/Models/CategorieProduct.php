<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use App\Filters\CategorieProductsFilter;

class CategorieProduct extends Model
{
    public $timestamps = true;
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    use Filterable, categorieProductsFilter;

    private static $whiteListFilter = ['*'];
    protected $guarded = [];

    public function delete($removeFile = true)
    {
        // if ($removeFile) {
        //     $this->fichier->delete();
        // }

        return parent::delete();
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id')->select(['id', 'username', 'email']);
    }

    public function fichier()
    {
        return $this->belongsTo(Fichier::class, 'fichier_id')->select(['id', 'filename']);;
    }
}
