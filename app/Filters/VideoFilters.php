<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class VideoFilters
{
    public function __construct(public Builder $builder)
    {
    }

    public function apply(array $params)
    {
        foreach ($params as $methodName => $value) {
            if (method_exists($this, $methodName) && !empty($value)) {
                $this->$methodName($value);
            }
        }

        return $this->builder;
    }

    private function q($value)
    {
        $this->builder->where('name', 'like', "%$value%");
    }

    private function sortBy($value)
    {
        if ($value == 'length') {
            $this->builder->orderBy('length', 'desc');
        }

        if ($value == 'like') {
            $this->builder->leftJoin('likes', function ($join) {
                $join->on('likes.likeable_id', '=', 'videos.id')
                    ->where('likeable_type', '=', 'App\Models\Video')
                    ->where('likes.vote', '=', '1');
            })
                ->groupBy('videos.id')
                ->select(['videos.*', DB::raw('count(likes.id) as count')])
                ->orderBy('count', 'desc');
        }

        if ($value == 'created_at') {
            $this->builder->orderBy('created_at', 'desc');
        }
    }

    private function length($value)
    {
        if ($value == 1) {
            $this->builder->where('length', '<', 600);
        }

        if ($value == 2) {
            $this->builder->whereBetween('length', [600, 1800]);
        }

        if ($value == 3) {
            $this->builder->where('length', '>', 1800);
        }
    }
}
