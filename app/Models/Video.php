<?php

namespace App\Models;

use App\Filters\VideoFilters;
use App\Models\Traits\Likeable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    /** @use HasFactory<\Database\Factories\VideoFactory> */
    use HasFactory, Likeable, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'description', 'file', 'thumbnail', 'length', 'views', 'category_id',
'user_id',
    ];

    protected $perPage = 3;

    //protected $hidden = ['category_id', 'user_id'];
    // protected $visible = ['name', 'slug'];
    //protected $appends = ['owner_name'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /* Accessor Methods */

    public function lengthInHuman(): Attribute
    {
        return Attribute::get(function () {
            return gmdate('i:s', $this->length);
        });
    }

    public function createdAt(): Attribute
    {
        return Attribute::get(function ($value) {
            $verta = new Verta($value);
            return $verta->formatDifference();
        });
    }

    public function videoThumbnail(): Attribute
    {
        return Attribute::get(fn() => '/storage/thumbnails/' . $this->thumbnail);
    }

    public function videoUrl(): Attribute
    {
        return Attribute::get(function () {
            return '/storage/videos/' . $this->file;
        });
    }

    public function categoryName(): Attribute
    {
        return Attribute::get(function () {
            return $this->category?->name;
        });
    }

    public function ownerName(): Attribute
    {
        return Attribute::get(function () {
            return $this->user?->name;
        });
    }

    public function ownerAvatar(): Attribute
    {
        return Attribute::get(function () {
            return $this->user?->gravatar;
        });
    }

    /* End Accessor Methods */

    /* Relation Methods */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    /* End Relation Methods */

    public function relatedVideos(int $count = 5): Collection
    {
        return $this->category->getRandomVideos($count)->except($this->id);
    }

    public function scopeFilter(Builder $builder, array $params): Builder
    {
        return (new VideoFilters($builder))->apply($params);
    }

}
