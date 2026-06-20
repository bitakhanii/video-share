<?php

namespace App\Models;

use App\Models\Traits\Likeable;
use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory, Likeable;

    protected $fillable = [
        'user_id', 'video_id', 'body',
    ];

    /* Relation Methods */
    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /* End Relation Methods */


    /* Accessor Methods */
    public function createdAt(): Attribute
    {
        return Attribute::make(get: fn($value) => (new Verta($value))->formatDifference()
        );
    }

    /* End Accessor Methods */
}
