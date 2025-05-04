<?php

namespace App\Support\Cost;

use App\Support\Cost\Contracts\AbstractCost;
use App\Support\Cost\Contracts\CostInterface;
use App\Support\Coupon\DiscountManager;

class DiscountCost extends AbstractCost
{
    private $discountManager;
    private $basketCost;

    public function __construct(CostInterface $cost, DiscountManager $discountManager, BasketCost $basketCost)
    {
        parent::__construct($cost);
        $this->discountManager = $discountManager;
        $this->basketCost = $basketCost;
    }

    public function getCost()
    {
        return $this->discountManager->calculateDiscount($this->basketCost->getCost());
    }

    public function getTotalCosts()
    {
        return $this->cost->getTotalCosts() - $this->getCost();
    }

    public function persianDescription()
    {
        return 'میزان تخفیف';
    }
}
