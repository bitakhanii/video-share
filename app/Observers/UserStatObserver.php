<?php

namespace App\Observers;

use App\Models\Topic\UserStat;
use App\Services\Badge\BadgeApplier;

class UserStatObserver
{
    /**
     * Handle the UserStat "created" event.
     */
    public function created(UserStat $userStat): void
    {
        //
    }

    /**
     * Handle the UserStat "updated" event.
     */
    public function updated(UserStat $userStat): void
    {
       (new BadgeApplier())->apply($userStat);
    }

    /**
     * Handle the UserStat "deleted" event.
     */
    public function deleted(UserStat $userStat): void
    {
        //
    }

    /**
     * Handle the UserStat "restored" event.
     */
    public function restored(UserStat $userStat): void
    {
        //
    }

    /**
     * Handle the UserStat "force deleted" event.
     */
    public function forceDeleted(UserStat $userStat): void
    {
        //
    }
}
