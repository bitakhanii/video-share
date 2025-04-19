<?php

namespace App\Support\Storage\Contracts;

Interface StorageInterface
{
    public function get($index);
    public function set($index, $value);
    public function exists($index);
    public function all();
    public function unset($index);
    public function clear();
    public function count();
}
