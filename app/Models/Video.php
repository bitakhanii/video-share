<?php

namespace App\Models;

use App\Models\Traits\Likeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    /** @use HasFactory<\Database\Factories\VideoFactory> */
    use HasFactory, Likeable;

    protected $fillable = [
        'name', 'slug', 'description', 'file', 'thumbnail', 'length', 'category_id', 'user_id',
    ];

    protected $perPage = 4;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getLengthInHumanAttribute()
    {
        return gmdate('i:s', $this->length);
    }

    public function getCreatedAtAttribute($value)
    {
        $verta = new Verta($value);
        return $verta->formatDifference();
    }

    public function relatedVideos(int $count = 5)
    {
        return $this->category->getRandomVideos($count)->except($this->id);

    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCategoryNameAttribute()
    {
        return $this->category?->name;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getOwnerNameAttribute()
    {
        return $this->user?->name;
    }

    public function getOwnerAvatarAttribute()
    {
        return $this->user?->gravatar;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    public function getVideoUrlAttribute()
    {
        return '/storage/' . $this->file;
    }

    public function getVideoThumbnailAttribute()
    {
        if (str_starts_with($this->thumbnail, 'http')) {
            return $this->thumbnail;
        } else {
            return '/storage/thumbnails/' . $this->thumbnail;
        }
    }
}
