<?php

namespace App\Support\Basket;

use App\Exceptions\QuantityExceededException;
use App\Models\Product;
use App\Support\Storage\Contracts\StorageInterface;
use Illuminate\Database\Eloquent\Collection;

class Basket
{
    private StorageInterface $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @throws QuantityExceededException
     */
    public function add(Product $product, int $quantity): void
    {
        if ($this->has($product)) {
            $quantity = $this->get($product)['quantity'] + $quantity;
        }

        $this->update($product, $quantity);
    }

    /**
     * @throws QuantityExceededException
     */
    public function update(Product $product, int $quantity): void
    {
        if (!$product->hasStock($quantity)) {
            throw new QuantityExceededException();
        }

        $this->storage->set($product->id, ['quantity' => $quantity]);
    }

    public function has(Product $product): bool
    {
        return $this->storage->exists($product->id);
    }

    public function get(Product $product): array
    {
        return $this->storage->get($product->id);
    }

    public function all(): Collection
    {
        $products = Product::query()->find(array_keys($this->storage->all()));

        foreach ($products as $product) {
            $product->quantity = $this->get($product)['quantity'];
        }

        return $products;
    }

    public function subTotal(): float|int
    {
        $total = 0;

        foreach ($this->all() as $product) {
            $total += $product->discountedPrice * $product->quantity;
        }

        return $total;
    }

    public function delete(Product $product): void
    {
        $this->storage->unset($product->id);
    }

    public function itemCount(): int
    {
        return $this->storage->count();
    }

    public function clear()
    {
        return $this->storage->clear();
    }
}
