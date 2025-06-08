<?php

namespace App\Services\Badge\Contracts;

use App\Models\Topic\UserStat;

interface Handler
{
    public function setNext(Handler $handler);

    public function handle(UserStat $userStat);
}
