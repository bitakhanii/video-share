<?php

namespace App\Models;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Reply extends Model
{
    protected $fillable = [
        'ticket_id', 'content', 'repliable_type', 'repliable_id',
    ];

    /* Relation Methods */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function repliable(): MorphTo
    {
        return $this->morphTo();
    }

    /* End Relation Methods */

    /* Accessor Methods */
    public function createdAt(): Attribute
    {
        return Attribute::get(function ($value) {
            return (new Verta($value))->formatDifference();
        });
    }

    /* End Accessor Methods */
}
