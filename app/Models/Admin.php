<?php

namespace App\Models;

use App\Services\Permission\Traits\HasPermissions;
use App\Services\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    public function test()
    {
       dd($this instanceof Admin);
    }

    protected $fillable = [
        'name', 'email', 'password', 'department',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'department', 'department');
    }

    public function replies()
    {
        return $this->morphMany(Reply::class, 'repliable');
    }

    public function isAdmin()
    {
        return $this instanceof Admin;
    }
}
