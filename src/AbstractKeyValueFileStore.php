<?php
require_once __DIR__ . '/KeyValueStoreInterface.php';

abstract class AbstractKeyValueFileStore implements KeyValueStoreInterface
{
    protected $file;

    abstract protected function load(): array;

    abstract protected function update(array $data): void;

    public function __construct(string $pathToFile)
    {
        $this->file = $pathToFile;
    }

    public function set(string $key, $value): void
    {
        $data = $this->load();
        $data[$key] = \is_object($value) ? \serialize($value) : $value;
        $this->update($data);
    }
    public function get(string $key, $default = null)
    {
        $data = $this->load();
        if (isset($data[$key])) {
            return $data[$key];
        }
        return $default;
    }
    public function has(string $key): bool
    {
        $data = $this->load();
        return isset($data[$key]);
    }
    public function remove(string $key): void
    {
        $data = $this->load();
        if (isset($data[$key])) {
            unset($data[$key]);
            $this->update($data);
        }
    }
    public function clear(): void
    {
        \file_put_contents($this->file, '', \LOCK_EX);
    }

}