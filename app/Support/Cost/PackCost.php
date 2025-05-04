<?php

namespace App\Support\Cost;

use App\Support\Cost\Contracts\AbstractCost;

class PackCost extends AbstractCost
{
    const PACK_COST = 10000;

    public function getCost()
    {
        return self::PACK_COST;
    }

    public function persianDescription()
    {
        return 'هزینه بسته‌بندی';
    }
}
