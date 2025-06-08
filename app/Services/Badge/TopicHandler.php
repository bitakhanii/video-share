<?php

namespace App\Services\Badge;

use App\Models\Topic\Badge;
use App\Models\Topic\UserStat;
use App\Services\Badge\Contracts\AbstractHandler;

class TopicHandler extends AbstractHandler
{
    public function handle(UserStat $userStat)
    {
        if ($userStat->isDirty('topic_count')) $this->applyBadge($userStat);
        return parent::handle($userStat);
    }

    protected function getAvailableBadge($userStat)
    {
        return Badge::topic()->where('required_number', '<=',
            $userStat->topic_count)->get();
    }
}
