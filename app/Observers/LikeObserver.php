<?php

namespace App\Observers;

use App\Models\Like;
use App\Notifications\ResourceWasLiked;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;

class LikeObserver
{
    /**
     * Handle the Like "created" event.
     */
    public function created(Like $like): void
    {
        $likeable = $like->likeable;

        Cache::forget('likes_count_for_'. class_basename($likeable).'_'. $likeable->id);
        Cache::forget('dislikes_count_for_'.class_basename($likeable).'_'.$likeable->id);

        Cache::put('likes_count_for_'.class_basename($likeable).'_'. $likeable->id, $likeable->likes()->where('vote', 1)->count(), 3600);
        Cache::put('dislikes_count_for_'.class_basename($likeable).'_'.$likeable->id, $likeable->likes()->where('vote', -1)->count(), 3600);

        $like->likeable->user->notify(new ResourceWasLiked(class_basename($likeable)));
    }

    /**
     * Handle the Like "updated" event.
     */
    public function updated(Like $like): void
    {
        //
    }

    /**
     * Handle the Like "deleted" event.
     */
    public function deleted(Like $like): void
    {
        //
    }

    /**
     * Handle the Like "restored" event.
     */
    public function restored(Like $like): void
    {
        //
    }

    /**
     * Handle the Like "force deleted" event.
     */
    public function forceDeleted(Like $like): void
    {
        //
    }
}
