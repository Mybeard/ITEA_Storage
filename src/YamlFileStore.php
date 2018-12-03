<?php
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__ . '/KeyValueStoreInterface.php';
use Symfony\Component\Yaml\Yaml;

class YamlFileStore implements KeyValueStoreInterface
{

    private $file;

    public function set($key, $value)
    {
        if (file_exists($this->file)) {
            $data = Yaml::parse(file_get_contents($this->file));
            $data[$key] = $value;
            $yaml = Yaml::dump($data);
            file_put_contents($this->file, $yaml);
        }

        else {
            $data[$key] = $value;
            $yaml = Yaml::dump($data);
            file_put_contents($this->file, $yaml);
        }
    }

    public function get($key, $default = null)
    {
        $data = Yaml::parse(file_get_contents($this->file));
        if (isset($data[$key])) {
            return $data[$key];
        }
        else {
            return $default;
        }
    }

    public function has($key): bool
    {
        $data = Yaml::parse(file_get_contents($this->file));
        return isset($data[$key]);
    }

    public function remove($key)
    {
        $data = Yaml::parse(file_get_contents($this->file));;
        unset($data[$key]);
        $yaml = Yaml::dump($data);
        file_put_contents($this->file, $yaml);
    }

    public function clear()
    {
        unlink($this->file);
    }

    public function __construct()
    {
        $filepath = __DIR__ . "/../bin/";
        $filename = time().".yml";
        $this->file = $filepath.$filename;
    }
}