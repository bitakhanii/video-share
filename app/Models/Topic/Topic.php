<?php

namespace App\Models\Topic;

use App\Models\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    const XP = 5;

    protected $fillable = [
        'user_id', 'title', 'text'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return (new Verta($value))->formatDifference();
    }
}
