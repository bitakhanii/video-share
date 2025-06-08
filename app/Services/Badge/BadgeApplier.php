<?php

namespace App\Services\Badge;

use App\Models\Topic\UserStat;

class BadgeApplier
{
    public function apply(UserStat $userStat)
    {
        $xpHandler = new XpHandler();
        $topicHandler = new TopicHandler();
        $replyHandler = new ReplyHandler();

        $xpHandler->setNext($topicHandler)->setNext($replyHandler);

        $xpHandler->handle($userStat);
    }
}
