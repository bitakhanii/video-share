<?php

namespace App\Support\Cost;

use App\Support\Cost\Contracts\AbstractCost;
use App\Support\Cost\Contracts\CostInterface;
use App\Support\Coupon\DiscountManager;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class DiscountCost extends AbstractCost
{
    private DiscountManager $discountManager;

    public function __construct(CostInterface $cost, DiscountManager $discountManager)
    {
        parent::__construct($cost);
        $this->discountManager = $discountManager;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getCost()
    {
        return $this->discountManager->calculateDiscount($this->cost->getTotalCosts());
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getTotalCosts()
    {
        return $this->cost->getTotalCosts() - $this->getCost();
    }

    public function persianDescription(): string
    {
        return 'میزان تخفیف';
    }
}
