<?php

namespace App\Services\Badge;

use App\Models\Topic\Badge;
use App\Models\Topic\UserStat;
use App\Services\Badge\Contracts\AbstractHandler;

class XpHandler extends AbstractHandler
{
    public function handle(UserStat $userStat)
    {
        if ($userStat->isDirty('xp')) $this->applyBadge($userStat);
        return parent::handle($userStat);
    }

    protected function getAvailableBadge($userStat)
    {
        return Badge::xp()->where('required_number', '<=',
            $userStat->xp)->get();
    }
}
