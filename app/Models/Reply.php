<?php

namespace App\Models;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
        'ticket_id', 'content', 'repliable_type', 'repliable_id',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function repliable()
    {
        return $this->morphTo();
    }

    public function getCreatedAtAttribute($value)
    {
        return (new Verta($value))->formatDifference();
    }
}
