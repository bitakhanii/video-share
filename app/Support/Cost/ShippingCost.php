<?php

namespace App\Support\Cost;

use App\Support\Cost\Contracts\AbstractCost;
use App\Support\Cost\Contracts\CostInterface;

class ShippingCost extends AbstractCost
{
    const SHIPPING_COST = 50000;

    public function getCost()
    {
        return self::SHIPPING_COST;
    }

    public function persianDescription()
    {
        return 'هزینه حمل و نقل';
    }
}
