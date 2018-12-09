<?php
require_once __DIR__ . '/KeyValueStoreInterface.php';

class PhpArrayStore implements KeyValueStoreInterface
{
    private $store = [];

    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
        $this->store[$key] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function get($key, $default = null)
    {
        if (isset($this->store[$key])) {
            return $this->store[$key];
        } else {
            return $default;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function has($key): bool
    {
        return isset($this->store[$key]);
    }

    /**
     * {@inheritdoc}
     */
    public function remove($key)
    {
        unset($this->store[$key]);
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        unset($this->store);
    }

}
