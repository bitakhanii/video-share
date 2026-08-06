<?php

namespace App\Models;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Ticket extends Model
{
    protected $fillable = [
        'user_id', 'title', 'content', 'file_path', 'status', 'priority', 'department',
    ];

    protected $attributes = [
        'status' => 0,
    ];

    /* Relation Methods */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }

    /* End Relation Methods */

    /* Accessor Methods */
    public function priorityTitle(): Attribute
    {
        return Attribute::get(function () {
            return ['کم', 'متوسط', 'زیاد'][$this->priority];
        });
    }

    public function statusTitle(): Attribute
    {
        return Attribute::get(function () {
            return ['ایجاد شده', 'ریپلای شده', 'بسته شده'][$this->status];
        });
    }

    public function departmentTitle(): Attribute
    {
        return Attribute::get(function () {
            return ['پشتیبانی', 'فنی', 'مالی'][$this->department];
        });

    }

    public function createdAt(): Attribute
    {
        return Attribute::get(function ($value) {
            return (new \Verta($value))->formatDifference();
        });
    }

    /* End Accessor Methods */

    public function getFile(): ?string
    {
        return $this->file_path
            ? Storage::url($this->file_path)
            : null;
    }

    public function isCreated(): bool
    {
        return $this->status === 0;
    }

    public function replied(): void
    {
        $this->status = 1;
        $this->save();
    }

    public function close(): void
    {
        $this->status = 2;
        $this->save();
    }

    public function isClosed(): bool
    {
        return $this->status == 2;
    }
}
