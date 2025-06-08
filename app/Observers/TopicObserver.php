<?php

namespace App\Observers;

use App\Models\Topic\Topic;

class TopicObserver
{
    /**
     * Handle the Topic "created" event.
     */
    public function created(Topic $topic): void
    {
        $topic->user->incrementXP(Topic::XP);
        $topic->user->incrementTopicCount();
    }

    /**
     * Handle the Topic "updated" event.
     */
    public function updated(Topic $topic): void
    {
        //
    }

    /**
     * Handle the Topic "deleted" event.
     */
    public function deleted(Topic $topic): void
    {
        //
    }

    /**
     * Handle the Topic "restored" event.
     */
    public function restored(Topic $topic): void
    {
        //
    }

    /**
     * Handle the Topic "force deleted" event.
     */
    public function forceDeleted(Topic $topic): void
    {
        //
    }
}
