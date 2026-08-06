<?php

namespace App\Models;

use App\Services\Permission\Traits\HasPermissions;
use App\Services\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    //protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password', 'department',
    ];

    /* Relation Methods */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'department', 'department');
    }

    public function replies(): MorphMany
    {
        return $this->morphMany(Reply::class, 'repliable');
    }

    /* End Relation Methods */

    public function isAdmin()
    {
        return $this instanceof Admin;
    }
}
