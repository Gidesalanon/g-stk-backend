<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;

class Setting extends Model
{
    use HasFactory;
    public $timestamps = true;

    use Filterable;
    private static $whiteListFilter = ['*'];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];

    public function delete($removeFile = true)
    {
        if ($removeFile) {
            $this->fichier->delete();
        }

        return parent::delete();
    }

    public function fichier()
    {
        return $this->belongsTo(Fichier::class, 'fichier_id')->select(['id', 'filename']);;
    }
}
