<?php

namespace App\Support\Cost;

use App\Support\Cost\Contracts\AbstractCost;

class PackCost extends AbstractCost
{
    public function getCost(): int
    {
        return config('settings.packingCost');
    }

    public function persianDescription(): string
    {
        return 'هزینه بسته‌بندی';
    }
}
