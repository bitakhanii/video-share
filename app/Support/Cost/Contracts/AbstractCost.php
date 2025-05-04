<?php

namespace App\Support\Cost\Contracts;

abstract class AbstractCost implements CostInterface
{
    protected $cost;

    public function __construct(CostInterface $cost)
    {
        $this->cost = $cost;
    }

    abstract public function getCost();
    abstract public function persianDescription();

    public function getTotalCosts()
    {
        return $this->getCost() + $this->cost->getTotalCosts();
    }

    public function getSummary()
    {
        return array_merge($this->cost->getSummary(), [$this->persianDescription() => $this->getCost()]);
    }
}
