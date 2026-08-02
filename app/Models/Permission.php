<?php

namespace App\Models;

use App\Services\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasRoles;

    protected $fillable = [
        'name',
        'persian_name',
    ];

    /* Relation Methods */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /* End Relation Methods */
}
