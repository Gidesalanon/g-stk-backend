<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use App\Filters\CommandsFilter;

class CommandProduct extends Model
{
    public $timestamps = true;
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    use Filterable, commandsFilter;

    private static $whiteListFilter = ['*'];
    protected $guarded = [];

    public function commands()
    {
        return $this->belongsTo(Selling::class, 'command_id')->select(['id', 'description', 'command_id']);
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
