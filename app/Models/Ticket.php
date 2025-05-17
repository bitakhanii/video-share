<?php

namespace App\Models;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ticket extends Model
{
    protected $fillable = [
        'user_id', 'title', 'content', 'file_path', 'status', 'priority', 'department',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function getPriorityTitleAttribute()
    {
        return ['کم', 'متوسط', 'زیاد'][$this->priority];
    }

    public function getStatusTitleAttribute()
    {
        return ['ایجاد شده', 'ریپلای شده', 'بسته شده'][$this->status];
    }

    public function getDepartmentTitleAttribute()
    {
        return ['پشتیبانی', 'فنی', 'مالی'][$this->department];
    }

    public function getCreatedAtAttribute($value)
    {
        return (new \Verta($value))->formatDifference();
    }

    public function getFile()
    {
        return $this->file_path
            ? Storage::url($this->file_path)
            : null;
    }

    public function isCreated()
    {
        return $this->status == 0;
    }

    public function replied()
    {
        $this->status = 1;
        $this->save();
    }

    public function close()
    {
        $this->status = 2;
        $this->save();
    }

    public function isClosed()
    {
        return $this->status == 2;
    }
}
