<?php
require_once __DIR__ . '/KeyValueStoreInterface.php';

class JsonFileStore implements KeyValueStoreInterface
{
    private $file;

    public function set($key, $value)
    {
        if (file_exists($this->file)) {
            $json = file_get_contents($this->file);
            $data = json_decode($json, true);
            $data[$key] = $value;
            $json = json_encode($data);
            file_put_contents($this->file, $json);
        }

        else {
            $data[$key] = $value;
            $json = json_encode($data);
            file_put_contents($this->file, $json);
        }
    }

    public function get($key, $default = null)
    {
        $json = file_get_contents($this->file);
        $data = json_decode($json, true);
        if (isset($data[$key])) {
            return $data[$key];
        }
        else {
            return $default;
        }
    }

    public function has($key): bool
    {
        $json = file_get_contents($this->file);
        $data = json_decode($json, true);
        return isset($data[$key]);
    }

    public function remove($key)
    {
        $json = file_get_contents($this->file);
        $data = json_decode($json, true);
        unset($data[$key]);
        $json = json_encode($data);
        file_put_contents($this->file, $json);
    }

    public function clear()
    {
        unlink($this->file);
    }

    public function __construct()
    {
        $filepath = __DIR__ . "/../bin/";
        $filename = time().".json";
        $this->file = $filepath.$filename;
    }


}