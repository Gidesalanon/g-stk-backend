<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use App\Filters\ClientsFilter;

class Client extends Model
{
    public $timestamps = true;
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    use Filterable, clientsFilter;

    private static $whiteListFilter = ['*'];
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id')->select(['id', 'username', 'email']);
    }

    public function commandes()
    {
        return $this->belongsTo(Command::class, 'client_id')->select(['id', 'description']);;
    }
}
