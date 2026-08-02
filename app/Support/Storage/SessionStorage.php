<?php

namespace App\Support\Storage;

use App\Support\Storage\Contracts\StorageInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReturnTypeWillChange;

class SessionStorage implements StorageInterface, \Countable
{
    private string $bucket;

    public function __construct(string $bucket = 'default')
    {
        $this->bucket = $bucket;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function get($index)
    {
        return session()->get($this->bucket . '.' . $index);
    }

    public function set($index, $value): null
    {
        return session()->put($this->bucket . '.' . $index, $value);
    }

    public function exists($index): bool
    {
        return session()->has($this->bucket . '.' . $index);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function all()
    {
        return session()->get($this->bucket) ?? [];
    }

    public function unset($index): void
    {
        session()->forget($this->bucket. '.' . $index);
    }

    public function clear(): void
    {
        session()->forget($this->bucket);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function count(): int
    {
        return $this->all() == null ? 0 : count($this->all());
    }
}
