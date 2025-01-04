<?php

namespace App\Models\Traits;

use App\Models\Like;
use App\Models\User;

trait Likeable
{
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->where('vote', 1)->count();
    }

    public function getDislikesCountAttribute()
    {
        return $this->likes()->where('vote', -1)->count();
    }

    public function likedBy(User $user)
    {
        if ($this->isDislikedBy($user)) {
            $this->getLikeable($user, -1)->delete();
            return $this->createLike($user);
        }

        if ($this->isLikedBy($user)) {
            return $this->getLikeable($user, 1)->delete();
        };

        $this->createLike($user);
    }

    public function dislikedBy(User $user)
    {
        if ($this->isLikedBy($user)) {
            $this->getLikeable($user, 1)->delete();
            return $this->createDislike($user);
        }

        if ($this->isDislikedBy($user)) {
            return $this->getLikeable($user, -1)->delete();
        }
        $this->createDislike($user);
    }

    private function isLikedBy(User $user)
    {
        return $this->getLikeable($user, 1)->exists();
    }

    private function isDislikedBy(User $user)
    {
        return $this->getLikeable($user, -1)->exists();
    }

    private function getLikeable(User $user, $vote)
    {
        return $this->likes()
            ->where('user_id', $user->id)
            ->where('vote', $vote);
    }

    private function createLike(User $user)
    {
        return $this->likes()->create([
            'user_id' => $user->id,
            'vote' => 1,
        ]);
    }

    private function createDislike(User $user)
    {
        return $this->likes()->create([
            'user_id' => $user->id,
            'vote' => -1,
        ]);
    }
}
