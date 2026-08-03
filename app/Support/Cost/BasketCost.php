<?php

namespace App\Support\Cost;

use App\Support\Basket\Basket;
use App\Support\Cost\Contracts\CostInterface;

class BasketCost implements CostInterface
{
    private Basket $basket;
    public function __construct(Basket $basket)
    {
        $this->basket = $basket;
    }

    public function getCost(): float|int
    {
        return $this->basket->subTotal();
    }

    public function getTotalCosts(): float|int
    {
        return $this->getCost();
    }

    public function persianDescription(): string
    {
        return 'سبد خرید';
    }

    public function getSummary(): array
    {
        return [
            $this->persianDescription() => $this->getTotalCosts(),
        ];
    }
}
