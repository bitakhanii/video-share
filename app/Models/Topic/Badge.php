<?php

namespace App\Models\Topic;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $fillable = [
      'title', 'description', 'type', 'required_number', 'icon_url'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function scopeXp($query)
    {
        return $query->where('type', 0);
    }

    public function scopeTopic($query)
    {
        return $query->where('type', 1);
    }

    public function scopeReply($query)
    {
        return $query->where('type', 2);
    }
}
