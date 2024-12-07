<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hekmatinasser\Verta\Verta;
class Video extends Model
{
    /** @use HasFactory<\Database\Factories\VideoFactory> */
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'url', 'thumbnail', 'length', 'category_id',
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
}
