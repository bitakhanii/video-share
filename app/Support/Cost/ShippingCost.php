<?php

namespace App\Support\Cost;

use App\Support\Cost\Contracts\AbstractCost;
use App\Support\Cost\Contracts\CostInterface;

class ShippingCost extends AbstractCost
{
    public function getCost(): int
    {
        return config('settings.shippingCost');
    }

    public function persianDescription(): string
    {
        return 'هزینه حمل و نقل';
    }
}
