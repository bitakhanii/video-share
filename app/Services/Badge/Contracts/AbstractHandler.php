<?php

namespace App\Services\Badge\Contracts;

use App\Models\Topic\UserStat;

abstract class  AbstractHandler implements Handler
{
    private $nextHandler;
    public function setNext(Handler $handler)
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(UserStat $userStat)
    {
        if ($this->nextHandler) {
            $this->nextHandler->handle($userStat);
        }

        return null;
    }

    protected function applyBadge(UserStat $userStat)
    {
        $availableBadge = $this->getAvailableBadge($userStat);

        $userBadges = $userStat->user->badges;

        $notReceivedBadge = $availableBadge->diff($userBadges);

        if ($notReceivedBadge->isEmpty()) return;

        $userStat->user->badges()->attach($notReceivedBadge);
    }
}
