<?php

namespace App\Models\Topic;

use App\Models\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    const XP = 2;

    protected $fillable = [
        'user_id', 'topic_id', 'text'
    ];

    protected $table = 'topic_replies';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return (new Verta($value))->formatDifference();
    }
}
