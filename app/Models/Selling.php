<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use App\Filters\SellingsFilter;

class Selling extends Model
{
    public $timestamps = true;
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    use Filterable, sellingsFilter;

    private static $whiteListFilter = ['*'];
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id')->select(['id', 'username', 'email']);
    }

    public function selling_products()
    {
        return $this->hasMany(SellingProduct::class);
    }

    public function clients()
    {
        return $this->belongsTo(Client::class, 'client_id')->select(['id', 'description', 'firstname','lastname','phone','email']);
    }

}
