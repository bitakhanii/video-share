<?php

namespace App\Services\Badge;

use App\Models\Topic\Badge;
use App\Models\Topic\UserStat;
use App\Services\Badge\Contracts\AbstractHandler;

class ReplyHandler extends AbstractHandler
{
    public function handle(UserStat $userStat)
    {
        if ($userStat->isDirty('reply_count')) $this->applyBadge($userStat);
        return parent::handle($userStat);
    }

    protected function getAvailableBadge($userStat)
    {
        return Badge::reply()->where('required_number', '<=',
            $userStat->reply_count)->get();
    }
}
