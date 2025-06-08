<?php

namespace App\Observers;

use App\Models\Topic\Reply;

class ReplyObserver
{
    /**
     * Handle the Reply "created" event.
     */
    public function created(Reply $reply): void
    {
        $reply->user->incrementXP(Reply::XP);
        $reply->user->incrementReplyCount();
    }

    /**
     * Handle the Reply "updated" event.
     */
    public function updated(Reply $reply): void
    {
        //
    }

    /**
     * Handle the Reply "deleted" event.
     */
    public function deleted(Reply $reply): void
    {
        //
    }

    /**
     * Handle the Reply "restored" event.
     */
    public function restored(Reply $reply): void
    {
        //
    }

    /**
     * Handle the Reply "force deleted" event.
     */
    public function forceDeleted(Reply $reply): void
    {
        //
    }
}
