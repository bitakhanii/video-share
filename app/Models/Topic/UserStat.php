<?php

namespace App\Models\Topic;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserStat extends Model
{
    protected $fillable = [
        'user_id', 'xp', 'topic_count', 'reply_count'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
