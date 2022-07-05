<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Support\Facades\Storage;

class Fichier extends Model
{
    use HasFactory;
    use Filterable;
    protected $table = 'fichiers';
    public $incrementing = false;
    protected $keyType = 'string';
    private static $whiteListFilter = ['*'];
    protected $guarded = [];

    public function deleteOnDisk($saveModel = false)
    {
        Storage::disk('public')->delete($this->filename);
        $this->filename = null;

        if ($saveModel) {
            $this->save();
        }

        return $this;
    }

    public function delete($removeOnDisk = true)
    {
        if ($removeOnDisk) {
            $this->deleteOnDisk();
        }

        return parent::delete();
    }
}
