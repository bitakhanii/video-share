<?php

namespace App\Models\Traits;

use App\Models\Like;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

trait Likeable
{
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function getLikesCountAttribute(): int
    {
        return Cache::remember(
            $this->cacheKey('likes'),
            3600,
            fn() => $this->likes()->where('vote', 1)->count()
        );
    }

    public function getDislikesCountAttribute(): int
    {
        return Cache::remember(
            $this->cacheKey('dislikes'),
            3600,
            fn() => $this->likes()->where('vote', -1)->count()
        );
    }

    public function likedBy(User $user): string
    {
        return $this->applyVote($user, 1);
    }

    public function dislikedBy(User $user): string
    {
        return $this->applyVote($user, -1);
    }

    public function isLikedBy(User $user): bool
    {
        return $this->getUserVote($user) === 1;
    }

    public function isDislikedBy(User $user): bool
    {
        return $this->getUserVote($user) === -1;
    }

    // ─────────── Private Helpers ─────────────

    private function getUserVote(User $user): ?int
    {
        return $this->likes()
            ->where('user_id', $user->id)
            ->value('vote');
    }

    private function applyVote(User $user, int $vote): string
    {
        $current = $this->getUserVote($user);

        if ($current === $vote) {
            $this->likes()->where('user_id', $user->id)->delete();
            $status = 'removed';
        } elseif ($current !== null) {
            // if user disliked before, and now she wants to like
            $this->likes()
                ->where('user_id', $user->id)
                ->update(['vote' => $vote]);
            $status = 'changed';
        } else {
            $this->likes()->create([
                'user_id' => $user->id,
                'vote' => $vote,
            ]);
            $status = 'added';
        }

        $this->forgetLikeCache();
        return $status;
    }

    private function cacheKey(string $type): string
    {
        return "{$type}_count_for_" . class_basename($this) . "_{$this->id}";
    }

    private function forgetLikeCache(): void
    {
        Cache::forget($this->cacheKey('likes'));
        Cache::forget($this->cacheKey('dislikes'));
    }
}
