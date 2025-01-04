<?php

namespace App\Observers;

use App\Models\Like;
use App\Notifications\ResourceWasLiked;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class LikeObserver implements ShouldQueue
{
    use Queueable;
    /**
     * Handle the Like "created" event.
     */
    public function created(Like $like): void
    {
        $likeable = class_basename($like->likeable_type);
        $like->likeable->user->notify(new ResourceWasLiked($likeable));
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
