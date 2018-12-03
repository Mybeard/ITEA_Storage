<?php
require_once __DIR__ . '/KeyValueStoreInterface.php';

class PhpArrayStore implements KeyValueStoreInterface
{
    private $store = [];

    public function set($key, $value)
    {
        $this->store[$key] = $value;

    }

    public function get($key, $default = null)
    {
        if (isset($this->store[$key])) {
            return $this->store[$key];
        }
        else {
            return $default;
        }
    }

    public function has($key): bool
    {
        return isset($this->store[$key]);

    }

    public function remove($key)
    {
        unset($this->store[$key]);
    }

    public function clear()
    {
        unset($this->store);
    }

    public function getStore()
    {
        return $this->store;
    }


}