<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Database\Eloquent\Model;
use App\Filters\UsersFilter;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    use Filterable, usersFilter;

    private static $whiteListFilter = ['*'];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guard_name = 'api';
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'parent_id',
        'username',
        'email',
        'password',
        'firstname',
        'lastname',
        'public',
        'deleted'
    ];
    //public $timestamps = false;
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\MailResetPasswordNotification($token));
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isRoot()
    {
        return $this->hasRole('root');
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function entreprises()
    {
        return $this->hasMany(Entreprise::class);
    }

    public function projets()
    {
        return $this->hasMany(Projet::class);
    }

    public function parents()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(User::class, 'parent_id');
    }
    public function allChildren()
    {
        return $this->children()->with('children', 'parents');
    }
    public function allParents()
    {
        return $this->parents()->with('children', 'parents');
    }

}
