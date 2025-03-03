<?php

namespace App\Models;

use App\Services\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasRoles;
    protected $fillable = [
        'name',
        'persian_name',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
